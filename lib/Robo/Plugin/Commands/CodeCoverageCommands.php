<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */
namespace SuiteCRM\Robo\Plugin\Commands;

use Mockery\Exception\RuntimeException;
use SuiteCRM\Utility\OperatingSystem;
use SuiteCRM\Robo\Traits\RoboTrait;
use Robo\Task\Base\loadTasks;
use SuiteCRM\Utility\Paths;
use Symfony\Component\Yaml\Yaml;

class CodeCoverageCommands extends \Robo\Tasks
{
    use loadTasks;
    use RoboTrait;

    /**
     * @throws RuntimeException
     */
    public function codeCoverage() {
        $this->say('Code Coverage');

        // Get environment
        if ($this->isEnvironmentTravisCI()) {
            $range = $this->getCommitRangeForTravisCi();
        } else {
           throw new RuntimeException('unable to detect continuous integration environment');
        }

        $filesChanged = $this->gitFilesChanged($range);
        $phpFiles = $this->filterFilesByExtension($filesChanged, 'php');

        if(empty($phpFiles)) {
            $this->generateEmptyCodeCoverageFile();
        } else {
            $this->disableStateChecker();
            $this->configureCodeCoverageFiles($phpFiles);
            $this->generateCodeCoverageFile();
        }


        $this->say('Code Coverage Completed');
    }

    /**
     * @return bool
     */
    protected function isEnvironmentTravisCI()
    {
        return !empty(getenv('TRAVIS'));
    }


    /**
     * @return array|false|string
     */
    protected function getCommitRangeForTravisCi()
    {
        return getenv('TRAVIS_COMMIT_RANGE');
    }

    /**
     * @return bool
     */
    protected function isTravisPullRequest()
    {
        return !empty(getenv('TRAVIS_PULL_REQUEST')) && getenv('TRAVIS_PULL_REQUEST') != false;
    }

    /**
     * @param $gitRange
     * @return array
     */
    protected function gitFilesChanged($gitRange)
    {
        $command = 'git diff --name-only ' . $gitRange . ' --diff-filter=ACMRT';
        $result =$this->_exec($command);
        return explode(PHP_EOL, $result->getMessage());
    }

    /**
     * @param $files
     * @param $extension
     * @return array
     */
    protected function filterFilesByExtension($files, $extension)
    {
        $filesFiltered = array();
        $paths = new Paths();
        $os = new OperatingSystem();
        $projectPath = $os->toOsPath($paths->getProjectPath());

        foreach ($files as $file)
        {

            if(file_exists($projectPath.DIRECTORY_SEPARATOR.$file)) {
                $pathinfo = pathinfo($file);
                if(!empty($pathinfo) && array_key_exists('extension', $pathinfo)) {
                    if ($pathinfo['extension'] === $extension) {
                        $filesFiltered[] = $file;
                        $this->say('found ' . $file);
                    };
                }
            }
        }
        return $filesFiltered;
    }

    /**
     * @param $files
     */
    protected function configureCodeCoverageFiles($files)
    {
        $config = $this->getCodeceptionYml();
        $config['coverage']['include'] = $files;
        $config['coverage']['exclude'] = array();
        $this->setCodeceptionYml($config);
    }

    /**
     *
     */
    protected function generateEmptyCodeCoverageFile()
    {
        $paths = new Paths();
        $os = new OperatingSystem();
        $projectPath = $os->toOsPath($paths->getProjectPath());
        $this->_copy(
            $projectPath . DIRECTORY_SEPARATOR . $os->toOsPath('tests/_data/empty-coverage.xml'),
            $projectPath . DIRECTORY_SEPARATOR . $os->toOsPath('tests/_output/coverage.xml')
        );
    }

    /**
     *
     */
    protected function generateCodeCoverageFile()
    {
        $paths = new Paths();
        $os = new OperatingSystem();
        $projectPath = $os->toOsPath($paths->getProjectPath());
        $this->_exec(
            $projectPath
            . DIRECTORY_SEPARATOR
            . $os->toOsPath('vendor/bin/codecept')
            . ' run unit --coverage-xml'
        );
    }

    /**
     *
     */
    protected function disableStateChecker()
    {
        require_once 'include/utils/file_utils.php';
        require 'config_override.php';
        $sugar_config['state_checker']['test_state_check_mode'] = 0;
        write_array_to_file(
            'sugar_config',
            $sugar_config,
            'config_override.php'
        );
    }

    /**
     * @return mixed
     */
    protected function getCodeceptionYml()
    {
        return Yaml::parseFile($this->getCodeceptionYmlPath());
    }

    /**
     * @param $config
     */
    protected function setCodeceptionYml($config)
    {
        file_put_contents($this->getCodeceptionYmlPath(), Yaml::dump($config));
    }

    /**
     * @return string
     */
    protected function getCodeceptionYmlPath()
    {
        $paths = new Paths();
        $os = new OperatingSystem();
        $projectPath = $os->toOsPath($paths->getProjectPath());
        return $projectPath . DIRECTORY_SEPARATOR . 'codeception.yml';
    }

}
