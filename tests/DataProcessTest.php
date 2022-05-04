<?php
/**
 * Created by PhpStorm.
 * User: bit
 * Date: 2022.05.03.
 * Time: 19:05
 */

namespace Webshippy;
use PHPUnit\Framework\TestCase;
use Webshippy\DataFromFile;

class DataProcessTest  extends TestCase
{

    public function testArgumentDataProcess()
    {
        $ProcessData = new ProcessData();

        // test json conversion
        $testArgument = ['','{"1":2,"2":3,"3":1}' ];
        $ProcessData->getArgumentData($testArgument);
        $stock = $ProcessData->getStock();
        $stockValid = new \stdClass();
        $stockValid->{1} = 2;
        $stockValid->{2} = 3;
        $stockValid->{3} = 1;
        $this->assertEquals( $stock, $stockValid );


        $LoadDataFromFile = new DataFromFile();
        $LoadDataFromFile->loadDataFromFile( 'tests/orders.csv' );
        $LoadDataFromFile->sortData();
        $ProcessData->prepareData( $LoadDataFromFile->getOrders(), $LoadDataFromFile->getOrdersHeader() );
        $processedData = $ProcessData->getProcessedData();

        $validData = [
            [ 'product_id' => 1, 'quantity' => 2, 'priority' => 'high', 'created_at' => '2021-03-25 14:51:47'],
            [ 'product_id' => 2, 'quantity' => 1, 'priority' => 'medium', 'created_at' => '2021-03-21 14:00:26'],
            [ 'product_id' => 3, 'quantity' => 1, 'priority' => 'medium', 'created_at' => '2021-03-22 12:31:54'],
            [ 'product_id' => 2, 'quantity' => 2, 'priority' => 'low', 'created_at' => '2021-03-24 11:02:06'],
            [ 'product_id' => 1, 'quantity' => 1, 'priority' => 'low', 'created_at' => '2021-03-25 19:08:22'],
        ];
        $this->assertEquals( $processedData, $validData );

    }

}