<?php
/**
 * Created by PhpStorm.
 * User: bit
 * Date: 2022.05.03.
 * Time: 14:46
 */

namespace Webshippy;

use PHPUnit\Framework\TestCase;
use Webshippy\Data\File;


class HeaderTest extends TestCase
{

    public function testGetHeaders()
    {
        $File = new File();
        $File->load('tests/orders.csv');
        $ordersHeader = $File->getOrdersHeader();
        $validArray = [ 'product_id','quantity','priority','created_at' ];
        $this->assertEquals( $validArray, $ordersHeader );
    }

}