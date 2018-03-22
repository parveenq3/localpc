<?php
// Test CVS

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read('VEIS_Employee_Details.xls');

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

error_reporting(E_ALL ^ E_NOTICE);

$con = mysqli_connect("localhost","root","","vgl");

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	// for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) { // Loop rowwise
		// echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";

		$empCode = $data->sheets[0]['cells'][$i][1];
		if( !empty($empCode) )
		{
			$fName = $data->sheets[0]['cells'][$i][2];
			$lName = $data->sheets[0]['cells'][$i][3];
			$empName = $fName.' '.$lName;

			$desgName = $data->sheets[0]['cells'][$i][4];
			$deptName = $data->sheets[0]['cells'][$i][5];
			$userType = $data->sheets[0]['cells'][$i][6];
			$email = $data->sheets[0]['cells'][$i][7];
			$location = $data->sheets[0]['cells'][$i][8];

			// $validateQry = mysqli_query($con, "SELECT * FROM administrator WHERE employee_code = '".$empCode."' ");
			// if( mysqli_num_rows($validateQry) <= 0 ){

				if( $i > 1 ){ // to ignore first row as it is headings
					$saveQuery = "INSERT INTO administrator SET
								employee_code = '".$empCode."',
								employee_name = '".$empName."',
								Designation = '".$desgName."',
								location = '".$location."',
								authorities = '0',
								department = '".$deptName."',
								usertype = '".$userType."',
								email = '".$email."',
								status = '1' ";
					echo $saveQuery.'<br/>';

					// mysqli_query($con, $saveQuery);
				}

			//}
		}

	// }
	echo "\n";

}


//print_r($data);
//print_r($data->formatRecords);
?>
