<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Dokument bez tytułu</title>
</head>

<body>
<?php

// define some variables
$local_file = 'latest.txt';
$server_file = '/230195/logs/latest.log';

// set up basic connection
$conn_id = ftp_ssl_connect("craftserve.pl") or die("Could not connect to $ftp_server");

// login with username and password
$login_result = ftp_login($conn_id,"dominik-kruszeski@wp.pl", "Pawelek1");

// try to download $server_file and save to $local_file
if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
    echo "Successfully written to $local_file\n";
} else {
    echo "There was a problem\n";
}

// close the connection
ftp_close($conn_id);

?>
</body>
</html>