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

    public function testArgumentDataProcess()
    {
        $Process = new Process();

        // test json conversion
        $testArgument = ['','{"1":2,"2":3,"3":1}' ];
        $Process->setArgument($testArgument);
        $stock = $Process->getStock();
        $stockValid = new \stdClass();
        $stockValid->{1} = 2;
        $stockValid->{2} = 3;
        $stockValid->{3} = 1;
        $this->assertEquals( $stock, $stockValid );

    }

}