<?php
$dir = '.';
include 'syspkg.php';
$models = str_replace($dir.'/','',(glob($dir.'/*.mod')));
$controllers = str_replace($dir.'/','',(glob($dir.'/*.ctl')));
$views = str_replace($dir.'/','',(glob($dir.'/*.app')));
$packages = str_replace($dir.'/','',(glob($dir.'/*.pkg')));
$resources = str_replace($dir.'/','',(glob($dir.'/*.res')));
if (file_get_contents('name')) {
    $projectTitleFile = file_get_contents('name');
    if ($projectTitleFile != '') {
        $projectTitle = $projectTitleFile;
    } else {
        $projectTitle = basename(__DIR__);
    }
} else {
    $projectTitle = basename(__DIR__);
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Web System Info</title>
<link rel="shortcut icon" href="sys.info.png?rev=<?=time();?>" type="image/x-icon">
<link href="system.css?rev=<?=time();?>" rel="stylesheet">
<?php include 'base.incl.php'; ?>
<?php include 'time.incl.php'; ?>
</head>
<body>
<div class='top'>
<p align="center">
<?php include 'getman.php'; ?>
</p>
</div>
<div class='panel'>
<p align="center">
    Website Name: <?=ucfirst($projectTitle);?>
</p>
<p align="center">
    System Info: <?=$syspkg['title'].' ('.$syspkg['type'].')';?>
</p>
<p align="center">
    System Time: <span id='servertime'></span>
</p>
<p align="center">Models: 
    <?php
    foreach ($models as $key=>$value) {
        $basename = basename($value, '.mod');
        echo ucfirst($basename).'; ';
    }
    ?>
</p>
<p align="center">Controllers: 
    <?php
    foreach ($controllers as $key=>$value) {
        $basename = basename($value, '.ctl');
        echo ucfirst($basename).'Controller; ';
    }
    ?>
</p>
<p align="center">Views: 
    <?php
    foreach ($views as $key=>$value) {
        $basename = basename($value, '.app');
        $openfile = file_get_contents($value);
        $opendiv = explode('|[1]|', $openfile);
        echo $opendiv[0].'; ';
    }
    ?>
</p>
<p align="center">Packages: 
    <?php
    foreach ($packages as $key=>$value) {
        $basename = basename($value, '.pkg');
        $openfile = file_get_contents($value);
        $opendiv = explode('|[1]|', $openfile);
        $openhead = $opendiv[0];
        $openparam = explode('|[2]|', $openhead);
        echo $openparam[0].'/'.$basename.'('.$openparam[3].'); ';
    }
    ?>
</p>
<p align="center">Resources: 
    <?php
    foreach ($resources as $key=>$value) {
        $basename = basename($value, '.pkg');
        $openfile = file_get_contents($value);
        echo $openfile.'; ';
    }
    ?>
</p>
</div>
</body>
</html>