<html>
	<head>
	<script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.32.min.js"></script>
	<script src="js/upload.js"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
	<script>
	function upload(){
		var file = document.getElementById('myFile').files[0];
		var filename = "testFile";
		uploadFile(file, filename);
	}
	</script>
	</head>

	
	<body>
		<form>
		<input type="file" id="myFile">
		<span onclick="upload()"> upload</span>
	</form>
	</body>

</html>