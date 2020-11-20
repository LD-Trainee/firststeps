<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class DoTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/start');
        $I->see('gib eine Zahl ein!');
        $I->click('Los');
        $I->see('du hast 0 eingegeben');
    }
}
