<?php
$imgDirectory = '/var/www/html/dedc/tarox/img';
$allItems = array_diff(scandir($imgDirectory), array('..', '.'));

$folders = array_filter($allItems, function($item) use ($imgDirectory) {
    return is_dir($imgDirectory . '/' . $item);
});

// Add New Deck Logic
if($folder){
$sourceDir = "/var/www/html/dedc/tarox/vulture/added/$folder";
$destDir = "/var/www/html/dedc/tarox/img/$folder";
}
?>