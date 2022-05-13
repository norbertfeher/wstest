<?php

namespace Webshippy\Controllers;
use Webshippy\Exceptions\InputFileException;
use Webshippy\Exceptions\InputJsonException;
use Webshippy\Exceptions\InputsNumberException;
use Webshippy\Validations\Input;
use Webshippy\Data\File;
use Webshippy\Data\Sort;
use Webshippy\Data\Process;
use Webshippy\Display\Display;

class Controller
{

    public function __construct( private int $argc=0, private array $argv=[], private string $fileName='' )
    {

    }


    // validate the user and file input
    private function inputValidation(): string
    {
        $InputValidation = new Input();
        $errorMessages = '';
        try {
            $InputValidation->checkInputNumbers($this->argc);
        }
        catch ( InputsNumberException $e )
        {
            $errorMessages .= $e->getMessage();
        }

        try {
            $InputValidation->checkInputIsJson($this->argv);
        }
        catch ( InputJsonException $e )
        {
            $errorMessages .= $e->getMessage();
        }

        try {
            $InputValidation->checkInputFile($this->fileName);
        }
        catch ( InputFileException $e )
        {
            $errorMessages .= $e->getMessage();
        }

        return $errorMessages;

    }

    // load and sort the order data from csv
    private function loadDataFromFile(): File
    {
        $File = new File();
        $File->load($this->fileName);

        $Sort = new Sort();
        $File->setOrders( $Sort->sort($File->getOrders() ) );

        return $File;
    }

    // process and filter orders
    private function processData( File $dataFromFile ): Process
    {
        $ProcessData = new Process();
        $ProcessData->setArgument($this->argv);
        $ProcessData->prepareData( $dataFromFile->getOrders(), $dataFromFile->getOrdersHeader() );
        return $ProcessData;
    }


    // start point of the app
    public function run()
    {
        $errorMessages = $this->inputValidation();
        if( !empty($errorMessages))
        {
            print 'Error: '. $errorMessages."\n";
        }
        else {
            $DataFromFile = $this->loadDataFromFile();
            $ProcessData = $this->processData($DataFromFile);
            $DisplayData = new Display();
            $DisplayData->display($ProcessData, $DataFromFile->getOrdersHeader());
        }
    }
}