<?php
/*
 *
 *  The methods in this class make the input validations (argument and file too)
 *
 */


namespace Webshippy;

use function PHPUnit\Framework\returnArgument;
use Webshippy\Exceptions\InputFileException;
use Webshippy\Exceptions\InputJsonException;
use Webshippy\Exceptions\InputsNumberException;


class InputValidation
{

    // check number of arguments
    public function checkInputNumbers(int $argc): bool
    {
        if ($argc != 2) {
            throw new InputsNumberException('Ambiguous number of parameters!');
        }
        else return true;
    }

    // check, that the argument is valid json
    public function checkInputIsJson(array $argv): bool
    {
        if ((json_decode($argv[1])) == null) {
            throw new InputJsonException('Invalid Json');
        }
        else return true;
    }

    // check, that the csv input file exists
    public function checkInputFile($fileName): bool
    {
        if( !is_file($fileName) ){
            throw new InputFileException('Json file not exists!');
        }
        else return true;
    }
}