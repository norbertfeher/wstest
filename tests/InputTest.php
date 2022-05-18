<?php

namespace Webshippy;

use Webshippy\Validations\Input;
use PHPUnit\Framework\TestCase;
use Webshippy\Exceptions\InputsNumberException;
use Webshippy\Exceptions\InputJsonException;
use Webshippy\Exceptions\InputFileException;


class InputTest extends TestCase
{
    private $input;
    public function setUp(): void
    {
        $this->input = new Input();
    }

    public function testInputNumberException()
    {

        $this->expectException( InputsNumberException::class );
        $this->input->checkInputNumbers(3);
    }

    public function testInputJsonException()
    {
        $this->expectException( InputJsonException::class );
        $this->input->checkInputIsJson(['', '']);
    }

    public function testInputFileException()
    {
        $this->expectException( InputFileException::class );
        $this->input->checkInputFile('');

    }


}