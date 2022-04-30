<?php

function elem($ext, $title, $method) {
    $dir = '.';
    echo $title.': ';
    $elem = str_replace($dir.'/','',(glob($dir.'/*.'.$ext)));
    foreach ($elem as $key=>$val) {
        if ($method == 'basename') {
            $base = basename($val, '.'.$ext);
            echo ucfirst($base).'; ';
        } elseif ($method == 'content') {
            $open = file_get_contents($val);
            echo $open.'; ';
        } elseif ($method == 'controller') {
            $base = basename($val, '.'.$ext);
            echo ucfirst($base).'Controller; ';
        }
    }
}

$dir = '.';
$models = str_replace($dir.'/','',(glob($dir.'/*.mod')));
$controllers = str_replace($dir.'/','',(glob($dir.'/*.ctl')));
$views = str_replace($dir.'/','',(glob($dir.'/*.app')));
$packages = str_replace($dir.'/','',(glob($dir.'/*.pkg')));
$resources = str_replace($dir.'/','',(glob($dir.'/*.res')));

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Web System Structure</title>
<link rel="shortcut icon" href="favicon.png?rev=<?=time();?>" type="image/x-icon">
<link href="system.css?rev=<?=time();?>" rel="stylesheet">
<?php include 'base.incl.php'; ?>
</head>
<body>
<div class='top'>
<p align="center">
<?php include 'getman.php'; ?>
</p>
</div>
<div class='panel'>
<p align="center">
    <?php elem('mod', 'Models', 'basename'); ?>
</p>
<p align="center">
    <?php elem('ctl', 'Controllers', 'controller'); ?>
</p>
<p align="center">
    <?php elem('app', 'Views', 'basename'); ?>
</p>
<p align="center">
    <?php elem('pkg', 'Packages', 'basename'); ?>
</p>
<p align="center">
    <?php elem('res', 'Resources', 'content'); ?>
</p>
</div>
</body>
</html>