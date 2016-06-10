<?php
$dir = __DIR__.'/'.$argv[1].'/';
$files = scandir($dir);

$log_file = __DIR__.'/writing_log.csv';

sort($files);
$word_count = 0;

$log_handler = fopen($log_file, 'a+');
$log = fread($log_handler, filesize($log_file));
$parts = explode(PHP_EOL, $log);
$last = count($parts) - 2;

foreach($files as $file) {
    if(preg_match('/[0-9]{3}/',$file)) {
        $string = file_get_contents($dir.$file);
        $word_count += str_word_count($string);
    }
}

$row = explode(',',$parts[$last]);
$difference = $word_count - $row[1];
$new_row = [
    date('Y-m-d H:i:s'),
    $word_count,
    $difference,
];

fwrite($log_handler, implode(',',$new_row).PHP_EOL);

echo "$word_count total ($difference since last tally)\n";




