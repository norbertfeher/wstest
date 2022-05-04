<?php
foreach ($ordersHeader as $headerItem) {
    echo str_pad($headerItem, 20);
}
?>

<?php
foreach ($ordersHeader as $headerItem) {
    echo str_repeat('=', 20);
}
?>

<?php
foreach ($processedData as $line)
{
    foreach ( $line as $item ) {
        echo str_pad($item, 20);
    }
    echo "\n";
}
?>


