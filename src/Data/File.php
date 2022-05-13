<?php

namespace Webshippy\Data;
use Webshippy\Exceptions\InputFileException;

class File
{

    public function __construct(private array $orders = [], private array $ordersHeader = []) {

    }

    public function load(string $FileName)
    {
        $row = 1;
        if (($handle = fopen($FileName, 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                if ($row == 1) {
                    $this->ordersHeader = $data;
                } else {
                    $orderItem = [];
                    for ($i = 0; $i < count($this->ordersHeader); $i++) {
                        $orderItem[$this->ordersHeader[$i]] = $data[$i];
                    }
                    $this->orders[] = $orderItem;
                }
                $row++;
            }
            fclose($handle);
        }
        else {
            throw new InputFileException('Json file not exists or can not be open!');
        }
    }

    public function getOrders(): array
    {
        return $this->orders;
    }

    public function getOrdersHeader(): array
    {
        return $this->ordersHeader;
    }

    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }

}