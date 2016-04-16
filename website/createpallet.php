<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"
	integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
	crossorigin="anonymous"></script>
	
	<script>
	function validatePallet(){
		return true;
	}
	
	function submitPallet(){
		if(!validatePallet()) return;
		$.post( "test.php", { 
			pal_name: $("pal_name").val(), 
			pal_id: $("pal_id").val(),
			pal_desc: $("pal_desc").val(),
			long: $("long").val(),
			lat: $("lat").val(),
			pic1: "?",
			pic2: "?",
			pack_id: $("wp_id").val(),
			pack_name: $("wp_name").val(),
			pack_desc: $("wp_desc").val(),
			pack_date: $("wp_date").val(),
			project: $("project").val()}, 
			function( data ) {
  			alert( "Data Posted: " + data );
		});
		
	}
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1>Pallet Finder</h1>
		<p>create pallet</p>
		<table>
			<tr>
				<td>
					Pallet Name:
				</td>
				<td>
					<input type="text" name="pallet_name" id="pallet_name">
				</td>
			</tr>
			<tr>
				<td>
					Pallet ID:
				</td>
				<td>
					<input type="text" name="pallet_id" id="pallet_id">
				</td>
			</tr>
			<tr>
				<td>
					Pallet Description:
				</td>
				<td>
					<input type="text" name="pallet_desc" id="pallet_desc">
				</td>
			</tr>
			<tr>
				<td>
					Longitude:
				</td>
				<td>
					<input type="text" name="long" id="long">
				</td>
			</tr>
			<tr>
				<td>
					Latitude:
				</td>
				<td>
					<input type="text" name="lat" id="lat">
				</td>
			</tr>
			<tr>
				<td>
					Pcture 1:
				</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>
					Picture 2:
				</td>
				<td>
					<input type="text">
				</td>
			</tr>
			<tr>
				<td>
					Work Package ID:
				</td>
				<td>
					<input type="text" name="wp_id" id="wp_id">
				</td>
			</tr>
			<tr>
				<td>
					Work Package Name:
				</td>
				<td>
					<input type="text" name="wp_name" id="wp_name">
				</td>
			</tr>
			<tr>
				<td>
					Work Package Description:
				</td>
				<td>
					<input type="text" name="wp_desc" id="wp_desc">
				</td>
			</tr>
			<tr>
				<td>
					Work Package Date:
				</td>
				<td>
					<input type="text" name="wp_date" id="wp_date">
				</td>
			</tr>
			<tr>
				<td>
					Project:
				</td>
				<td>
					<input type="text" name="project" id="project">
				</td>
			</tr>
		</table>
		
		<input type="submit" value="Submit" onclick="submitPallet()">
	</div>
	
	
</body>
</html>