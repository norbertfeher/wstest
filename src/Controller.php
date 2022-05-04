<?php

namespace Webshippy;
use Webshippy\InputValidation;
use Webshippy\DataFromFile;
use Webshippy\ProcessData;
use Webshippy\DisplayData;

class Controller
{

    public function __construct( private int $argc=0, private array $argv=[], private string $fileName='' )
    {

    }

    // validate the user and file input
    private function inputValidation(): bool
    {
        $InputValidation = new InputValidation();
        if ( $InputValidation->checkInputNumbers($this->argc) && $InputValidation->checkInputIsJson($this->argv) && $InputValidation->checkInputFile($this->fileName)){
            return true;
        }
        else return false;
    }

    // load and sort the order data from csv
    private function loadDataFromFile(): DataFromFile
    {
        $LoadDataFromFile = new DataFromFile();
        $LoadDataFromFile->loadDataFromFile( $this->fileName);
        // we need the orders by order of priority and time
        $LoadDataFromFile->sortData();
        return $LoadDataFromFile;
    }

    // process and filter orders
    private function processData( DataFromFile $dataFromFile ): ProcessData
    {
        $ProcessData = new ProcessData();
        $ProcessData->getArgumentData($this->argv);
        $ProcessData->prepareData( $dataFromFile->getOrders(), $dataFromFile->getOrdersHeader() );
        return $ProcessData;
    }


    // start point of the app
    public function run()
    {
        $this->inputValidation();
        $DataFromFile = $this->loadDataFromFile();
        $ProcessData = $this->processData( $DataFromFile );
        $DisplayData = new DisplayData();
        $DisplayData->display( $ProcessData, $DataFromFile->getOrdersHeader() );

    }
}