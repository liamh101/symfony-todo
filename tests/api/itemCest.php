<?php 

class itemCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function getAllItems(ApiTester $I)
    {
        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');
        $I->sendGET('/items');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
    }
}
