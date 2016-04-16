<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"
	integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
	crossorigin="anonymous"></script>
	<script src="js/global.js"></script>
	
	
	<style>
	#no-results{
		display:none;
		margin-top:20px;
	}
	#results{
		display:none;
		margin-top:20px;
	}
	</style>
	
	<script>
	
	function validatePallet(){
		return true;
	}
	
	function findPallet(){
		$.support.cors = true;
		if(!validatePallet()) return;
		
	    $.ajax({
	               url: GLOBAL_API_ENDPOINT + "/item.cgi?",
	               type: "get",
	               crossDomain: true,
	               data: $.param({pal_id: $("#pallet_id").val()}),
					/*dataType:"json",*/
	               success: function (response) {
	                   // var resp = JSON.parse(response)
// 	                   alert(resp.status);
					   //alert( "Data Posted: " + response );
					   if(!IsJsonString(response)) return;
					   var data = JSON.parse(response);
					   $('#no-results').hide();
					   $('#results').show();
					   
					   //$("#result-table").find("tr:gt(0)").remove();
					   
					   var pallet = data;
					   var itemName = pallet.pallet_name;
					   var itemID = pallet.pallet_id;
					   var desc = pallet.pallet_desc;
					   var longitude = pallet.longitude;
					   var latitude = pallet.latitude;
					   var img1url = pallet.pic1;
					   var img2url = pallet.pic2;
					   var wp_id;
					   var wp_name;
					   var wp_desc = pallet.pack_desc;
					   var project;
					   var loc = pallet.location;
					   
					   $("#pallet_name").val(itemName);
					   $("#pallet_id").val(itemID);
					   $("#pallet_desc").val(desc);
					   
					   $("#long").val(longitude);
					   $("#lat").val(latitude);
					   
					   $("#pic1img").attr('src', img1url);
					   $("#pic2img").attr('src', img2url);
					   
					   //$("#wp_id").val(wp_id);
					   //$("#wp_name").val(wp_name);
					   $("#wp_desc").val(wp_desc);
					   $("#loc").val(loc);
					   
					   
					   //$("#project").val(project);
					   
					   //addResult(itemName, itemID, desc);
					   $("#editButton").prop("disabled",true);
					   
	               },
	               error: function (xhr, status) {
					   $('#no-results').show();
					   $('#results').hide();
					   
	                   //alert("error");
	               }
	           });
		
		// $.get( GLOBAL_API_ENDPOINT + "/find.cgi?", {
// 			pal_name: $("pal_name").val(),
// 			pal_id: $("pal_id").val()},
// 			function( data ) {
// 	 			alert( "Data Posted: " + data );
// 		});
	}
	
	function edit(){
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
	
	function addResult(itemName, itemID, itemDesc){
		$("#results").show();
		$("#results").find('tbody')
    		.append($('<tr>')
        		.append($('<td>').text(itemName)
					
            		/*.append($('<img>')
                		.attr('src', 'img.png')
                		.text('Image cell')
            	)*/
				
        	).append($('<td>').text(itemID))
			.append($('<td>').text(itemDesc))
    	);
	}
	
	$(function() {
	  	var presetPallet = getUrlParameter('id');
		if(presetPallet != undefined)
			$("#pallet_id").val(presetPallet);
	});
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1><a href="/"><img src="images/pallet_100.png" id="pallet_logo"/></a>Pallet Finder</h1>
		<p>edit a pallet</p>
		<div class="good-message">pallet saved</div>
		<div class="bad-message">error</div>
		<table class="blue">
			<tr>
				<td>
					Pallet ID:
				</td>
				<td>
					<input type="text" name="pallet_id" id="pallet_id">
				</td>
			</tr>
		</table>
		
		<button onclick="findPallet()" id="editButton">edit</button>
		
		<div class="bad-red" id="no-results">No Results</div>
		
		<div id="results">
			<table class="blue" id="result-table">
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
						<img id="pic1img">
					</td>
				</tr>
				<tr>
					<td>
						Picture 2:
					</td>
					<td>
						<input type="file" id="pic2" accept="image/*">
						<img id="pic2img">
						
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
				<tr>
					<td>
						Location:
					</td>
					<td>
						<input type="text" name="loc" id="loc">
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
			</table>
		
			<input type="submit" value="Update" onclick="edit()">
		</div>
		
	</div>
	
	<div id="footer">iNNovate Hackathon 2016</div>
	
	
	
</body>
</html>