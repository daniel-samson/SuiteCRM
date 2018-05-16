<?php

namespace Step\Acceptance;

class Reports extends \AcceptanceTester
{

    const TAB_FIELDS = 0;
    const TAB_CONDITIONS = 1;
    const TAB_CHARTS = 1;
    /**
     * Go to the reports
     */
    public function gotoReports()
    {
        $I = new NavigationBar($this->getScenario());
        $I->clickAllMenuItem('Reports');
    }

    /**
     * Go to user profile
     */
    public function gotoProfile()
    {
        $I = new NavigationBar($this->getScenario());
        $I->clickUserMenuItem('Profile');
    }

    /**
     * Create a report
     *
     * @param $name
     * @param $module
     */
    public function createReport($name, $module)
    {
        $I = new EditView($this->getScenario());
        $I->waitForEditViewVisible();
        $I->fillField('#name', $name);
        $I->selectOption('#report_module', $module);
    }

    /**
     * Create an account
     *
     * @param $name
     */
    public function createAccount($name)
    {
        $I = new EditView($this->getScenario());
        $DetailView = new DetailView($this->getScenario());
        $Sidebar = new SideBar($this->getScenario());

        $I->see('Create Account', '.actionmenulink');
        $Sidebar->clickSideBarAction('Create');
        $I->waitForEditViewVisible();
        $I->fillField('#name', $name);
        $I->fillField('#phone_office', '(810) 267-0146');
        $I->fillField('#website', 'www.afakeurl.com');
        $I->clickSaveButton();
        $DetailView->waitForDetailViewVisible();
    }

    /**
     * Add a field to a report
     *
     * @param string $name
     * @param string $module
     * @param int $tab
     * @throws \Exception
     */
    public function addField($name, $module, $tab = self::TAB_FIELDS)
    {
        $I = new EditView($this->getScenario());
        $I->waitForElementVisible('#fieldTree', 5);
        $I->waitForElementVisible('#fieldTreeLeafs', 5);
        $I->waitForElementVisible('#fieldTree > .jqtree-tree', 5);
        $I->waitForElementVisible('#fieldTree > .jqtree-tree > li', 5);

        $I->see($module, '#fieldTree > .jqtree-tree > li > div > span');

        switch ($tab) {
            case self::TAB_FIELDS:
                $dropSelector = '#fieldLines';
                break;
            case self::TAB_CONDITIONS:
                $dropSelector = '#aor_conditionLines';
                break;
            case self::TAB_CHARTS:
                $dropSelector = '#chartLines';
                break;
        }

        $this->triggerClickEventOnTextNode($module, '#fieldTree > .jqtree-tree > li > div > span');
        $this->dragAndDropField($name, $dropSelector);
    }

    private function triggerClickEventOnTextNode($text, $selector)
    {
       $script = 'Array.from(document.querySelectorAll(\''.$selector.'\')).filter(element => element.innerText === \''.$text.'\')[0].click()';
       $this->executeJS($script);
    }

    private function indexOfFieldTree($field)
    {
        $this->wait(2);
        $indexOfFieldTree = $this->executeJS('return Array.from(document.querySelectorAll(\'#fieldTreeLeafs > .jqtree-tree > li > div > span\')).findIndex((a) => a.innerHTML === \''.$field.'\')');
        if ($indexOfFieldTree == -1) {
            throw  new \RuntimeException('Unable to determine the index of field "' . $field .  '" in field tree');
        }
        return $indexOfFieldTree;
    }

    private function dragAndDropField($field, $dropSelector)
    {
        $indexOfField = $this->indexOfFieldTree($field);
        $source = '#fieldTreeLeafs > .jqtree-tree > li:nth-of-type('.$indexOfField.') > div > span';
        $this->dragAndDrop($source, $dropSelector);
    }

    /**
     * Adds condition to report
     * @param $condition
     * @param $module
     */
    public function addCondition($condition, $module)
    {
        $I = new EditView($this->getScenario());

        $I->click('Conditions', '.toggle-detailpanel_conditions');
        $this->addField($condition, $module, self::TAB_CONDITIONS);
    }
}