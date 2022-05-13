<?php
/*
 *
 *  The methods in this class make the input validations (argument and file too)
 *
 */


namespace Webshippy\Validations;

use function PHPUnit\Framework\returnArgument;
use Webshippy\Exceptions\InputFileException;
use Webshippy\Exceptions\InputJsonException;
use Webshippy\Exceptions\InputsNumberException;


class Input
{

    // check number of arguments
    public function checkInputNumbers(int $argc): void
    {
        if ($argc != 2) {
            throw new InputsNumberException('Ambiguous number of parameters! ');
        }

    }

    // check, that the argument is valid json
    public function checkInputIsJson(array $argv): void
    {
        if ((json_decode($argv[1])) == null) {
            throw new InputJsonException('Invalid Json! ');
        }

    }

    // check, that the csv input file exists
    public function checkInputFile($fileName): void
    {
        if( !is_file($fileName) ){
            throw new InputFileException('Json file not exists! ');
        }

    }
}