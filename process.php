<?php
$base = __DIR__.'/';
$dir = $base.$argv[1].'/';
$files = scandir($dir);

$newFile = fopen($base.$argv[2], 'a+');

sort($files);

foreach($files as $file) {
    if(preg_match('/[0-9]{3}/',$file)) {
        $string = file_get_contents($dir.$file).PHP_EOL.PHP_EOL;
        //$newFile = fopen($dir.'/new/'.$file.'.mmd', 'w+');
        fwrite($newFile, $string);
    }
}


