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
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testGetCommitRangeForTravisCi()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testIsTravisPullRequest()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testGitFilesChanged()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testFilterFilesByExtension()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testConfigureCodeCoverageFiles()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testGenerateEmptyCodeCoverageFile()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testGenerateCodeCoverageFile()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testDisableStateChecker()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    public function testGetCodeceptionYml()
    {
        $reflection = new ReflectionClass(CodeCoverageCommands::class);
        $method = $reflection->getMethod('getCodeceptionYml');
        $method->setAccessible(true);
        $this->assertNotEmpty($method->invoke(self::$testClass));
    }

    protected function testSetCodeceptionYml()
    {
        $this->markTestIncomplete('Test Not implemented');
    }

    protected function testGetCodeceptionYmlPath()
    {
        $reflection = new ReflectionClass(CodeCoverageCommands::class);
        $method = $reflection->getMethod('getCodeceptionYmlPath');
        $method->setAccessible(true);
        $this->assertNotEmpty($method->invoke(self::$testClass));
    }

}