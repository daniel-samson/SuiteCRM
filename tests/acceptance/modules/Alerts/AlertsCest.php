<?php

class AlertsCest
{
    public function testScenarioDisableAlerts(
        \AcceptanceTester $I,
        \Step\Acceptance\NavigationBar $navigationBar,
        \Step\Acceptance\EditView $editview,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('Disable alerts in user profile');

        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        $I->loginAsAdmin();

        $navigationBar->clickUserMenuItem('Profile');
        $I->click('Advanced');
        $I->uncheckOption('.popup_chkbox');
        $I->uncheckOption('.email_chkbox');

        $editview->clickSaveButton();
    }
}