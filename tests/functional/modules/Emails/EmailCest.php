<?php

use Faker\Generator;

class EmailCest
{
    /**
     * @var string $lastView helps the test skip some repeated tests in order to make the test framework run faster at the
     * potential cost of being accurate and reliable
     */
    protected $lastView;

    /**
     * @var Generator $fakeData
     */
    protected $fakeData;

    /**
     * @var integer $fakeDataSeed
     */
    protected $fakeDataSeed;

    /** @var  \GuzzleHttp\Client */
    protected $mailcatcher;

    /**
     * @param AcceptanceTester $I
     */
    public function _before(AcceptanceTester $I, \Codeception\Lib\Connector\Guzzle $guzzle)
    {
        $this->mailcatcher = new \GuzzleHttp\Client('http://127.0.0.1:1080');
        $this->cleanMessages();
    }

    /**
     * @param AcceptanceTester $I
     */
    public function _after(AcceptanceTester $I)
    {
    }

    public function cleanMessages()
    {
        $this->mailcatcher->delete('/messages')->send();
    }

    // Tests
    /**
     * @param \AcceptanceTester $I
     *
     * As an administrator I want to create and deploy a basic module so that I can test
     * that the basic functionality is working. Given that I have already created a module I expect to deploy
     * the module before testing.
     */
    public function testSSendEmail(\AcceptanceTester $I) {
        $I->wantTo('Send an email via mailcatcher');
    }
}