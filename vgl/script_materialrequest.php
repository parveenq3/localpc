<?php

include_once("db_connection.php");
error_reporting(E_ALL ^ E_NOTICE);
function getEmplyoyeeDetails(){
	$url = "https://vgl-proauto-ws.cloudhub.io/api/employee-sync/";
	$post = "";

	try {
	    set_time_limit(600);
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_VERBOSE, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',
	        'Content-Length: ' . strlen($post))
	    );
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
	} catch (customException $e) {
	    echo $e->errorMessage();
	}
}

$resultData = getEmplyoyeeDetails();

$responseArray = json_decode($resultData);
$users = $responseArray->resultSet1;

$employeeId = array();
foreach ($users as $key => $value) {
	$employeeId[trim($value->Emp_Id)] = trim($value->employee_code);
}
// echo"<pre>";print_r($employeeId);

$locationArr = array(
	'SEZ' => '1',
	'E-68' => '2',
	'E-69' => '3'
);

$mrResult = mysqli_query($conn, 'SELECT * FROM material_requests');
while($mrData = mysqli_fetch_assoc($mrResult)){
	$pId = $mrData['id'];
	$approverId = $mrData['approver_id'];
	$reqNum = $mrData['request_number'];
	if(!empty($employeeId[$approverId])){
		echo 'UPDATE material_requests SET approver_id = "'.$employeeId[$approverId].'"  WHERE id = '.$pId.' ';
		echo"<br/>";
		mysqli_query($conn, 'UPDATE material_requests SET approver_id = "'.$employeeId[$approverId].'"  WHERE id = '.$pId.' ');
	}

	$location = $mrData['location'];
	
	if(!empty($locationArr[$location])){
		echo 'UPDATE material_requests SET location_id = "'.$locationArr[$location].'"  WHERE id = '.$pId.' ';
		echo"<br/>";
		mysqli_query($conn, 'UPDATE material_requests SET location_id = "'.$locationArr[$location].'"  WHERE id = '.$pId.' ');
	}

	$approvalStatus = mysqli_query($conn, 'SELECT date_created FROM all_approval_status WHERE material_request_id = "'.$pId.'" AND request_type="Request_Approval" ');
	if(mysqli_num_rows($approvalStatus) > 0){
		$approvalDate = mysqli_fetch_assoc($approvalStatus);
		$approvedDate = $approvalDate['date_created'];
		echo 'UPDATE material_requests SET date_approved = "'.$approvedDate.'"  WHERE id = '.$pId.' ';
		echo"<br/>";
		mysqli_query($conn, 'UPDATE material_requests SET date_approved = "'.$approvedDate.'"  WHERE id = '.$pId.' ');
	}

}

echo "======== Records updated =========";

?>