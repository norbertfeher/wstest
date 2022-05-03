<?php

namespace Webshippy;

use Webshippy\InputValidation;
use PHPUnit\Framework\TestCase;
use Webshippy\Exceptions\InputsNumberException;
use Webshippy\Exceptions\InputJsonException;
use Webshippy\Exceptions\InputFileException;


class InputTest extends TestCase
{

    public function testInputNumberException()
    {
        $obj = new InputValidation();

        try {
            $obj->checkInputNumbers(3);
        } catch (InputsNumberException $exception) {
            $this->assertInstanceOf(InputsNumberException::class, $exception);
        }

    }

    public function testInputJsonException()
    {
        $obj = new InputValidation();
        try {
            $obj->checkInputIsJson(['', '']);
        } catch (InputJsonException $exception) {
            $this->assertInstanceOf(InputJsonException::class, $exception);
        }
    }

    public function testInputFileException()
    {
        $obj = new InputValidation();
        try {
            $obj->checkInputFile('');
        } catch (InputFileException $exception) {
            $this->assertInstanceOf(InputFileException::class, $exception);
        }
    }


}