<html>
	<head>
	<script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.32.min.js"></script>
	<script src="js/upload.js"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
	<script>
	function upload(){
		var file = document.getElementById('myFile');
		var filename = "testFile";
		uploadFile(file, fileName);
	}
	</script>
	</head>

	
	<body>
		<input type="file" id="myFile">
		<span onlick="upload"> upload</span>
	</body>

</html>