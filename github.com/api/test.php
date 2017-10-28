<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<p>hello world</p>

<?php 

$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
asort($age);
var_dump($age);
ksort($age);
var_dump($age);
arsort($age);
var_dump($age);
krsort($age);
?>
</body>
</html>