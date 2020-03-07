<?php 

class itemCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function getAllItems(ApiTester $I): void
    {
        $I->haveInDatabase('item', ['id' => 1, 'name' => 'Hello World', 'completed' => false]);
        $I->haveInDatabase('item', ['id' => 2, 'name' => 'Success', 'completed' => true]);

        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');
        $I->sendGET('/items');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'hydra:totalItems' => 2,
                'hydra:member' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Hello World',
                        'completed' => false,
                    ],
                    1 => [
                        'id' => 2,
                        'name' => 'Success',
                        'completed' => true,
                    ]
                ],
            ]
        );
    }

    public function getIncompleteItems(ApiTester $I): void
    {
        $I->haveInDatabase('item', ['id' => 1, 'name' => 'Incomplete Item', 'completed' => false]);
        $I->haveInDatabase('item', ['id' => 2, 'name' => 'Completed Item', 'completed' => true]);

        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');
        $I->sendGET('/items?completed=false');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'hydra:totalItems' => 1,
                'hydra:member' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Incomplete Item',
                        'completed' => false,
                    ],
                ],
            ]
        );
    }

    public function getCompletedItems(ApiTester $I): void
    {
        $I->haveInDatabase('item', ['id' => 1, 'name' => 'Incomplete Item', 'completed' => false]);
        $I->haveInDatabase('item', ['id' => 2, 'name' => 'Completed Item', 'completed' => true]);

        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');
        $I->sendGET('/items?completed=true');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'hydra:totalItems' => 1,
                'hydra:member' => [
                    0 => [
                        'id' => 2,
                        'name' => 'Completed Item',
                        'completed' => true,
                    ],
                ],
            ]
        );
    }

    public function getSingleItem(ApiTester $I)
    {
        $I->haveInDatabase('item', ['id' => 1, 'name' => 'Hello World', 'completed' => false]);

        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');
        $I->sendGET('/items/1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'id' => 1,
                'name' => 'Hello World',
                'completed' => false,
            ]
        );
    }

    public function createSingleItem(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');

        $I->sendPOST('/items', [
                'name' => 'This is a post Test',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'id' => 1,
                'name' => 'This is a post Test',
                'completed' => false,
            ]
        );

        $I->sendGET('/items/1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'id' => 1,
                'name' => 'This is a post Test',
                'completed' => false,
            ]
        );
    }

    public function updateSingleItem(ApiTester $I)
    {
        $I->haveInDatabase('item', ['id' => 1, 'name' => 'Hello World', 'completed' => false]);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');

        $I->sendPUT('/items/1', [
            'name' => 'Hello World Updated',
            'completed' => true,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseContainsJson([
            'id' => 1,
            'name' => 'Hello World Updated',
            'completed' => true,
        ]);

        $I->sendGET('/items/1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'id' => 1,
                'name' => 'Hello World Updated',
                'completed' => true,
            ]
        );
    }

    public function deleteSingleItem(ApiTester $I)
    {
        $I->haveInDatabase('item', ['id' => 1, 'name' => 'Hello World', 'completed' => false]);
        $I->haveHttpHeader('Accept', 'application/json, text/plain, */*');

        $I->sendDELETE('/items/1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NO_CONTENT);

        $I->dontSeeInDatabase('item', ['id' => 1, 'name' => 'Hello World', 'completed' => false]);

        $I->sendGET('/items/1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
    }
}
