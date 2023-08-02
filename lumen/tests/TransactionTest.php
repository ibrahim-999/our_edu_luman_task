<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
// use Tests\TestCase;
use Laravel\Lumen\Testing\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    //    ./vendor/bin/phpunit --filter TransactionTest::testTransaction
    public function testTransaction()
    {
        $response = $this->json('GET', '/api/v1/transactions');
        $response->assertResponseStatus(200);
        $response->seeJson(['parentEmail'=> 'parent1@parent.eu']);
        $response->seeJson(['email'=> 'parent1@parent.eu']);

    }

    public function testTransactionStatusCode()
    {
        $response = $this->json('GET', '/api/v1/transactions?statusCode=decline');
        $response->assertResponseStatus(200);
        $response->seeJson(['statusCode'=> 2]);
    }

    public function testTransactionCurrency()
    {
        $response = $this->json('GET', '/api/v1/transactions?currency=EGP');
        $response->assertResponseStatus(200);
        $response->seeJson(['Currency'=> 'EGP']);
    }

    public function testTransactionAmountRange()
    {
        $response = $this->json('GET', '/api/v1/transactions?amounteMin=280&amounteMax=500');
        $response->assertResponseStatus(200);
        $response->seeJson(['paidAmount'=> 280]);

    }

    public function testTransactionDateRange()
    {
        $response = $this->json('GET', '/api/v1/transactions?startDate=2018-11-30&endDate=2021-09-07');
        $response->assertResponseStatus(200);
        $response->seeJson(['paymentDate'=> "2021-02-27"]);

    }
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
