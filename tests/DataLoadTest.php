<?php
/**
 * Created by PhpStorm.
 * User: bit
 * Date: 2022.05.03.
 * Time: 14:46
 */

namespace Webshippy;

use PHPUnit\Framework\TestCase;


class DataLoadTest extends TestCase
{

    public function testGetHeaders()
    {
        $DataFromFile = new DataFromFile();
        $DataFromFile->loadDataFromFile('tests/orders.csv');
        $ordersHeader = $DataFromFile->getOrdersHeader();
        $validArray = [ 'product_id','quantity','priority','created_at' ];
        $this->assertEquals( $validArray, $ordersHeader );
    }


    public function testGetOrders()
    {
        $DataFromFile = new DataFromFile();

        $DataFromFile->loadDataFromFile('tests/orders.csv');
        $orders = $DataFromFile->getOrders();
        // only csv decoded data
        $this->assertEquals( md5(serialize($orders)), '1c12ce53e9646e44166131439b0fd30c' );


        $DataFromFile->sortData();
        $orders = $DataFromFile->getOrders();
        // sorted data
        $this->assertEquals( md5(serialize($orders)), '9c4666f2b0ca50eb2df391e5ec23f3a7' );

    }

}