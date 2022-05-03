<?php

namespace Webshippy;
use Webshippy\InputValidation;

class Controller
{

    public function __construct( private int $argc=0, private array $argv=[], private string $fileName='' )
    {

    }

    // validate the input
    private function inputValidation(): bool
    {
        $InputValidation = new InputValidation();
        if ( $InputValidation->checkInputNumbers($this->argc) && $InputValidation->checkInputIsJson($this->argv) && $InputValidation->checkInputFile($this->fileName)){
            return true;
        }
        else return false;
    }


    // start point of the app
    public function run()
    {
        $this->inputValidation();
    }
}