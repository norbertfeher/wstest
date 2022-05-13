<?php
/**
 * Created by PhpStorm.
 * User: bit
 * Date: 2022.05.03.
 * Time: 15:51
 */

namespace Webshippy\Data;


class Process
{
    // stock data
    private $stock;
    // store the processed and filtered data
    private $processedData = [];

    // set the stock data, transform to array and store
    public function setArgument(array $argv)
    {
        $data = json_decode($argv[1]);
        $this->stock = $data;
    }

    public function getStock(): object {
        return $this->stock;
    }

    // process raw data to thw view, filter by the stock
    public function prepareData( $orders )
    {
        $priority = [1=>'low',2=>'medium',3=>'high'];
        $priorityIndex = null;

        foreach ($orders as $item) {
            if ($this->stock->{$item['product_id']} >= $item['quantity']) {
                $item['priority'] = $priority[ $item['priority'] ];
                $this->processedData[] = $item;
            }

        }
    }

    public function getProcessedData(): array
    {
        return $this->processedData;
    }

}