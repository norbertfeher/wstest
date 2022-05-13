<?php

namespace Webshippy\Data;

class Sort{


    function sort(array $orders): array
    {
        usort($orders, function ($a, $b) {
            $pc = -1 * ($a['priority'] <=> $b['priority']);
            return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
        });
        return $orders;
    }

}
