<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dokument bez tytułu</title>
</head>

<body>
<?
$filename = "ftp://s474946:Pawelek1@185.38.249.23/logs/latest.log";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;
?>
</body>
</html>