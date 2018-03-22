<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
	</head>
	<body>
	
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Name</th>
					<th>Position</th>
					<th>Office</th>
					<th>Extn.</th>
					<th>Start date</th>
					<th>Salary</th>
				</tr>
			</thead>
		</table>
		
		
		<script>
			$(document).ready(function() {
				$('#example').DataTable( {
					"ajax": "data/arrays.txt"
				} );
			} );
		</script>
	</body>
</html>