<?php

namespace Webshippy;


class DisplayData
{

    public function display( ProcessData $processData, array $ordersHeader )
    {
        $processedData = $processData->getProcessedData();

        require_once __DIR__.'/views/view.php';

    }

}