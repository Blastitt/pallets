<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"
	integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
	crossorigin="anonymous"></script>
	
	<script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.32.min.js"></script>
	<script src="js/upload.js"></script>
	
	<script>
	
	function validatePallet(){
		return true;
	}
	
	function submitPallet(){
		if(!validatePallet()) return;
		$.post( "api/store.php", { 
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
			/* if success, iupload to amazon */
			var palletID = "???";
			var pic1file = document.getElementById("#pic1").files[0];
			var pic2file = document.getElementById("#pic2").files[0];
			
			uploadFile(pic1file, palletID+"_pic1");
			uploadFile(pic2file, palletID+"_pic2");
			
		});
		
	}
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1><img src="images/pallet_100.png" id="pallet_logo"/>Pallet Finder</h1>
		<h2>create pallet</h2>
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
					Picture 1:
				</td>
				<td>
					<input type="file" id="pic1">
				</td>
			</tr>
			<tr>
				<td>
					Picture 2:
				</td>
				<td>
					<input type="file" id="pic2">
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
	
	<div id="footer">iNNovate Hackathon 2016</div>
	
	
</body>
</html>