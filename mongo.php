<?php
	$m = new MongoClient();
	
	echo "Connection to database successfully";
	$db = $m->mydb;

	echo "Database mydb selected";

	$collection = $db->createCollection("mycol");
   	echo "Collection created succsessfully";

   	$document = array(
		"_id"	=>	12,
		"name" => "parveen", 
		"comany" => "q3tech", 
		"class" => 'php'
	);

	$collection->insert($document);
	echo "Document inserted successfully";

?>