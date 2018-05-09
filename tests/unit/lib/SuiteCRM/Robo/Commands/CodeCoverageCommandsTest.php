<?php
class CodeCoverageCommandsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        parent::_before();
    }

    public function testGetCodeceptionYml()
    {
        $reflection = new ReflectionClass(\SuiteCRM\Robo\Plugin\Commands\CodeCoverageCommands::class);
        $method = $reflection->getMethod('getCodeceptionYml');
        $method->setAccessible(true);
        $this->assertNotEmpty($method->invoke(new \SuiteCRM\Robo\Plugin\Commands\CodeCoverageCommands()));
    }
}