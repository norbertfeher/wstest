<?php

namespace Webshippy;

use Webshippy\Validations\Input;
use PHPUnit\Framework\TestCase;
use Webshippy\Exceptions\InputsNumberException;
use Webshippy\Exceptions\InputJsonException;
use Webshippy\Exceptions\InputFileException;


class InputTest extends TestCase
{

    public function testInputNumberException()
    {
        $obj = new Input();

        try {
            $obj->checkInputNumbers(3);
        } catch (InputsNumberException $exception) {
            $this->assertInstanceOf(InputsNumberException::class, $exception);
        }

    }

    public function testInputJsonException()
    {
        $obj = new Input();
        try {
            $obj->checkInputIsJson(['', '']);
        } catch (InputJsonException $exception) {
            $this->assertInstanceOf(InputJsonException::class, $exception);
        }
    }

    public function testInputFileException()
    {
        $obj = new Input();
        try {
            $obj->checkInputFile('');
        } catch (InputFileException $exception) {
            $this->assertInstanceOf(InputFileException::class, $exception);
        }
    }


}