AWS.config.region = 'us-east-1'; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    IdentityPoolId: 'us-east-1:11127aa9-1cd7-4202-805c-f0ca3576c9a0',
});

function uploadFile(file, filename){
	var bucket = new AWS.S3({params: {Bucket: 'palletpics'}, region: 'us-east-1'});
	var params = {Key: filename, ContentType: file.type, Body: file};
	bucket.upload(params).
		on('httpUploadProgress', function(evt) {
				/*progress.setAttribute("value", evt.loaded/ evt.total);*/
				console.log('Progress:', evt.loaded, '/', evt.total); 
			}).
			send(function(err, data) { console.log(err, data);
			if(!err){
				console.log('Success:'); 
				
			} else{
				console.log('failure')			
			}
		});
}