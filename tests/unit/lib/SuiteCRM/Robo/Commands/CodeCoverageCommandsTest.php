<?php
class CodeCoverageCommandsTest extends SuiteCRM\StateCheckerUnitAbstract
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
        $this->assertNotEmpty($method->invoke($reflection));
    }
}