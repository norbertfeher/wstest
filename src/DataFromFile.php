<?php

namespace Webshippy;
use Webshippy\Exceptions\InputFileException;

class DataFromFile
{
    public function __construct(private array $orders = [], private array $ordersHeader = []) {

    }

    public function loadDataFromFile(string $FileName): void
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

    public function sortData(): void
    {
        usort($this->orders, function ($a, $b) {
            $pc = -1 * ($a['priority'] <=> $b['priority']);
            return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
        });
    }

    public function getOrders(): array
    {
        return $this->orders;
    }

    public function getOrdersHeader(): array
    {
        return $this->ordersHeader;
    }
}