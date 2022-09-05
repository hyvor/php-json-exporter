<?php
namespace Feature;

use Hyvor\JsonExporter\File;

it('efficiently writes a large dataset', function() {

    $file = new File('test.json');

    $collection = $file->collection('users');

    for ($i = 1; $i < 6000000000; $i++) {
        $item = [
            'name' => 'supun',
            'title' => 'Founder & CEO',
            'company' => 'Hyvor',
            'website' => 'https://supun.io'
        ];

        $collection->addItems([$item]);
    }

    $file->end();

    var_dump(formatBytes(memory_get_peak_usage()));
    var_dump(formatBytes(filesize('test.json')));
    die;

})->skip();

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}