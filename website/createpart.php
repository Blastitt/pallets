<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<script>
	function validatePart(){
		var partName = document.getElementById("part_name").value;
		if(partName.trim().length == 0)
			return false;
		
	}
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1>Pallet Finder</h1>
		<h2>create part</h2>
	
		<form action ="api/createpart.php" onsubmit="return validatePart()">
		<table>
			<tr>
				<td>
					Name:
				</td>
				<td>
					<input type="text" name="part_name" id="part_name">
				</td>
			</tr>
		</table>
		
		<input type="submit" value="Submit">
		
	</form>
	</div>
	
	
</body>
</html>