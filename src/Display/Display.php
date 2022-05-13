<?php

namespace Webshippy\Display;

use Webshippy\Data\Process;

class Display
{

    public function display(Process $processData, array $ordersHeader )
    {
        $processedData = $processData->getProcessedData();

        require_once __DIR__ . '/../Views/view.php';

    }

}