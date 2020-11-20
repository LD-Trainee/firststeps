<?php namespace App\Tests;
use App\Tests\ApiTester;

class CreateUserCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
        echo 'Zitat erstellen Test:';
        $I->sendPost('/zitat/', json_encode([
            'zitat' => 'TestZitat#CodeCeption#'.date("Y.m.d-l")
        ]));
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('true');
    }
}
