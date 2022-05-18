<?php
/**
 * Created by PhpStorm.
 * User: bit
 * Date: 2022.05.03.
 * Time: 19:05
 */

namespace Webshippy;
use PHPUnit\Framework\TestCase;
use Webshippy\Data\Process;


class ProcessTest  extends TestCase
{

    private $process;

    public function setUp(): void
    {
        $this->process = new Process();
    }

    public function testArgumentDataProcess()
    {
        // test json conversion
        $testArgument = ['','{"1":2,"2":3,"3":1}' ];
        $this->process->setArgument($testArgument);
        $stock = $this->process->getStock();
        $stockValid = new \stdClass();
        $stockValid->{1} = 2;
        $stockValid->{2} = 3;
        $stockValid->{3} = 1;
        $this->assertEquals( $stock, $stockValid );
    }

    public function testPrepare()
    {
        $stockValid = new \stdClass();
        $stockValid->{1} = 2;
        $stockValid->{2} = 3;
        $stockValid->{3} = 1;

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

        $validOrders = [
            [
                'product_id' => 1,
                'quantity' => 1,
                'priority' => 'high',
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 1,
                'quantity' => 1,
                'priority' => 'low',
                'created_at' => '2021-03-25 14:51:47'
            ],
            [
                'product_id' => 2,
                'quantity' => 1,
                'priority' => 'low',
                'created_at' => '2021-03-25 14:51:47'
            ],
        ];

        $testArgument = ['','{"1":2,"2":3,"3":1}' ];
        $this->process->setArgument($testArgument);
        $this->process->prepareData( $ordersSorted );
        $processedData = $this->process->getProcessedData();
        $this->assertSame( $processedData, $validOrders );

    }

}