<?php

namespace Webshippy;
use PHPUnit\Framework\TestCase;
use Webshippy\Data\Sort;
use Webshippy\Data\File;


class SortTest  extends TestCase
{

    public function testSorting()
    {
        $orders = [
            [
                'product_id' => 1,
                'quantity' => 1,
                'priority' => 1,
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 1,
                'quantity' => 3,
                'priority' => 1,
                'created_at' => '2021-03-20 14:51:47'
            ],
            [
                'product_id' => 1,
                'quantity' => 1,
                'priority' => 3,
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 2,
                'quantity' => 1,
                'priority' => 1,
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 2,
                'quantity' => 10,
                'priority' => 2,
                'created_at' => '2021-02-25 14:51:47'
            ],
        ];

        $ordersSorted = [
            [
                'product_id' => 1,
                'quantity' => 1,
                'priority' => 3,
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 2,
                'quantity' => 10,
                'priority' => 2,
                'created_at' => '2021-02-25 14:51:47'
            ],
            [
                'product_id' => 1,
                'quantity' => 3,
                'priority' => 1,
                'created_at' => '2021-03-20 14:51:47'
            ],
            [
                'product_id' => 1,
                'quantity' => 1,
                'priority' => 1,
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 2,
                'quantity' => 1,
                'priority' => 1,
                'created_at' => '2021-03-25 14:51:47'
            ],
        ];

        $Sort = new Sort(  );
        $result = $Sort->sort( $orders );
        $this->assertSame( $result, $ordersSorted );

    }

}