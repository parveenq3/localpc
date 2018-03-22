<?php
// Connect to the database (host, username, password)
// $con = sqlsrv_connect('172.16.100.7','uatuser','uat@123') or die('Could not connect to the server!');
ini_set('max_execution_time', 0);
$serverName = "203.129.200.102"; //serverName\instanceName
$connectionInfo = array( "Database"=>"JewelsIntdb_New", "UID"=>"uatuser", "PWD"=>"uat@123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
 
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$started = time();

$sql = "select * from GetItemForEindent";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

$c = 0;
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	echo"<pre>";print_r($row);
	$c++;
}

$end = time();

$difference = $end - $started;
echo 'sec=='.$difference;
echo 'count=='.$c;

sqlsrv_free_stmt( $stmt);

?>