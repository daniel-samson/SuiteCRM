<?php

use \SuiteCRM\Robo\Plugin\Commands\CodeCoverageCommands;

class CodeCoverageCommandsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var \SuiteCRM\Robo\Plugin\Commands\CodeCoverageCommands **/
    protected static $testClass;

    public function _before()
    {
        parent::_before();

        if (self::$testClass === null) {
            self::$testClass = new CodeCoverageCommands();
        }
    }

    protected function testIsEnvironmentTravisCI()
    {}

    protected function testGetCommitRangeForTravisCi()
    {}

    protected function testIsTravisPullRequest()
    {}

    protected function testGitFilesChanged()
    {}

    protected function testFilterFilesByExtension()
    {}

    protected function testConfigureCodeCoverageFiles()
    {}

    protected function testGenerateEmptyCodeCoverageFile()
    {}

    protected function testGenerateCodeCoverageFile()
    {}

    protected function testDisableStateChecker()
    {}

    public function testGetCodeceptionYml()
    {
        $reflection = new ReflectionClass(CodeCoverageCommands::class);
        $method = $reflection->getMethod('getCodeceptionYml');
        $method->setAccessible(true);
        $this->assertNotEmpty($method->invoke(self::$testClass));
    }

    protected function testSetCodeceptionYml()
    {}

    protected function testGetCodeceptionYmlPath()
    {}

}