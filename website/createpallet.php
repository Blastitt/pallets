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
	<script src="js/global.js"></script>
	
	
	<script>
	
	function validatePallet(){
		return true;
	}
	
	function submitPallet(){
		if(!validatePallet()) return;
		var pic1guid = guid() + ".png";
		var pic2guid = guid() + ".png";
		
		
	    $.ajax({
	               url: GLOBAL_API_ENDPOINT + "/store.cgi?",
	               type: "get",
	               crossDomain: true,
	               data: $.param({ 
			pal_name: $("#pallet_name").val(), 
			pal_id: $("#pallet_id").val(),
			pal_desc: $("#pallet_desc").val(),
			long: $("#long").val(),
			lat: $("#lat").val(),
			pic1: "https://s.amazonaws.com/palletpics/"+pic1guid,
			pic2: "https://s.amazonaws.com/palletpics/"+pic2guid,
			//pack_id: $("wp_id").val(),
			//pack_name: $("wp_name").val(),
			pack_desc: $("#wp_desc").val(),
			//pack_date: $("wp_date").val(),
			loc: $("#loc").val()
			//project: $("project").val()
		}),
	               success: function (response) {
	                   // var resp = JSON.parse(response)
// 	                   alert(resp.status);
					   //alert( "Data Posted: " + response );
		   			/* if success, iupload to amazon */
					   if(document.getElementById("pic1").files.length > 0){
		   				   var pic1file = document.getElementById("pic1").files[0];
   		   				   uploadFile(pic1file, pic1guid);
					   }
					   if(document.getElementById("pic2").files > 0){
	   		   			var pic2file = document.getElementById("pic2").files[0];
	   		   			uploadFile(pic2file, pic2guid);
					   }
		   			
			
		   			$(".good-message").show();
					   
	               },
	               error: function (xhr, status) {
					   $(".bad-message").show();
					   
	                   //alert("error");
	               }
	           });
		
		
		
		
	}
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1><a href="/"><img src="images/pallet_100.png" id="pallet_logo"/></a>Pallet Finder</h1>
		<h2>create pallet</h2>
		<div class="good-message">pallet saved</div>
		<div class="bad-message">error</div>
		
		<table class="blue">
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
					<input type="file" id="pic1" accept="image/*">
				</td>
			</tr>
			<tr>
				<td>
					Picture 2:
				</td>
				<td>
					<input type="file" id="pic2" accept="image/*">
				</td>
			</tr>
			<!-- <tr>
				<td>
					Work Package ID:
				</td>
				<td>
					<input type="text" name="wp_id" id="wp_id">
				</td>
			</tr> -->
			<!-- <tr>
				<td>
					Work Package Name:
				</td>
				<td>
					<input type="text" name="wp_name" id="wp_name">
				</td>
			</tr> -->
			<tr>
				<td>
					Work Package Description:
				</td>
				<td>
					<input type="text" name="wp_desc" id="wp_desc">
				</td>
			</tr>
			<!-- <tr>
				<td>
					Work Package Date:
				</td>
				<td>
					<input type="text" name="wp_date" id="wp_date">
				</td>
			</tr> -->
			<!-- <tr>
				<td>
					Project:
				</td>
				<td>
					<input type="text" name="project" id="project">
				</td>
			</tr> -->
			<tr>
				<td>
					Loc:
				</td>
				<td>
					<input type="text" name="loc" id="loc">
				</td>
			</tr>
		</table>
		
		<input type="submit" value="Submit" onclick="submitPallet()">
		
		
	</div>
	
	<div id="footer">iNNovate Hackathon 2016</div>
	
	
</body>
</html>