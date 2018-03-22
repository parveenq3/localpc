<?php
// Connect to the database (host, username, password)
// $con = sqlsrv_connect('172.16.100.7','uatuser','uat@123') or die('Could not connect to the server!');
ini_set('max_execution_time', 0);
// $serverName = "115.113.189.49"; //serverName\instanceName
$serverName = "203.129.200.102";
// $connectionInfo = array( "Database"=>"DealerManagementPortalDev", "UID"=>"sa", "PWD"=>"Q3tech123");
$connectionInfo = array( "Database"=>"jewelsintdb_new", "UID"=>"uatuser", "PWD"=>"uat@123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
 
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

// $sqlQuery = "SELECT TABLE_NAME
//             FROM INFORMATION_SCHEMA.TABLES
//             WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_CATALOG='DealerManagementPortalDev'";
$sqlQuery = "SELECT * FROM GetItemDetailsForProAuto";
$stmt = sqlsrv_query($conn, $sqlQuery);
while ($row = sqlsrv_fetch_array($stmt)) {
    echo"<pre>";
    print_r($row);
 
}

// Select a database:
// mssql_select_db('jewelsintdb') or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
/*$SQL = "SELECT TOP 10 * FROM ExampleTable ORDER BY ID ASC";
 
// Execute query:
$result = mssql_query($SQL) 
    or die('A error occured: ' . mysql_error());
 
// Get result count:
$Count = mssql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";
 
// Fetch rows:
while ($Row = mssql_fetch_assoc($result)) {
 
    print $Row['Fieldname'] . "\n";
 
} 
mssql_close($con);*/

?>