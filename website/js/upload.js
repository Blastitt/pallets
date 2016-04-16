AWS.config.credentials = AWS.config.credentials = new new CognitoCachingCredentialsProvider(
	getApplicationContext(),
	"us-east-1:11127aa9-1cd7-4202-805c-f0ca3576c9a0", // Identity Pool ID
	Regions.US_EAST_1 // Region
);

// Configure your region
AWS.config.region = 'us-east-1';

function uploadFile(file, filename){
	var bucket = new AWS.S3({params: {Bucket: 'pallets'}, region: 'us-east-1'});
	var params = {Key: filename, ContentType: file.type, Body: file};
	bucket.upload(params).
		on('httpUploadProgress', function(evt) {
				progress.setAttribute("value", evt.loaded/ evt.total);
				console.log('Progress:', evt.loaded, '/', evt.total); 
			}).
			send(function(err, data) { console.log(err, data);
			if(!err){
				console.log('Success:', evt.loaded, '/', evt.total); 
				
			} else{
				console.log('failure')			
			}
		});
}