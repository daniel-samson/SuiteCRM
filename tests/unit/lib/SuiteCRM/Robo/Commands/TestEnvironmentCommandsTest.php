<?php

use \SuiteCRM\Robo\Plugin\Commands\TestEnvironmentCommands;

class TestEnvironmentCommandsTest extends \Codeception\Test\Unit
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
            self::$testClass = new TestEnvironmentCommands();
        }
    }

    public function testGetDefaultGatewayLinux() {
        self::$testClass->getDefaultGatewayLinux();
    }
}