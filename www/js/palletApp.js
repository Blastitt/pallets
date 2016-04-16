/*jslint browser:true, devel:true, white:true, vars:true */
/*global $:false, intel:false */

if(localStorage.getItem("LocalData") === null)
{
    var data = [];
    data = JSON.stringify(data);
    localStorage.setItem("LocalData", data);
}

var pictureSource;   // picture source
var destinationType; // sets the format of returned value   

function onAppReady() {

    if( navigator.splashscreen && navigator.splashscreen.hide ) {   // Cordova API detected

        navigator.splashscreen.hide() ;

    }

    if( window.intel && intel.xdk && intel.xdk.device ) {           // Intel XDK device API detected, but...

        if( intel.xdk.device.hideSplashScreen )                     // ...hideSplashScreen() is inside the base plugin

            intel.xdk.device.hideSplashScreen() ;

    }

    pictureSource=navigator.camera.PictureSourceType;

    destinationType=navigator.camera.DestinationType;

}


$("#btnSrchByText").click(function(){
    
    
   if(TextSearchValid()){
    

       var queryGet =  "137.155.2.154/api/find.php?Pal_id=" +
            $("#srchPalID").val() + "&Pal_name=" +
            $("#srchPalName").val();
       //137.155.2.154/api/find.php?Pal_id=12345&Pal_Name=
        alert(queryGet);
        $.ajax({
          url: queryGet,
          type: "post",
          data: "12345",
          datatype: 'json',
          success: function(data){
              alert(data);
            },
          error:function(){
            alert("error");   
            }
        });
    }
    else{
        
        alert("Invalid");
    }
    
});

function TextSearchValid(){
    
    if(!$("#srchPalID").val() && !$("#srchPalName").val())
        return false;
    
    var palid = $("#srchPalID").val();
    if (palid !== "" && !$.isNumeric(palid))
        return false;
//    if($("#srchPalID").val() && !("#srchPalID").val().isNumeric())
//        return false;
    
    console.log("Valid entries");
    return true;
    
}

//       $.each( data, function( key, val ) {
//    items.push( "<li id='" + key + "'>" + val + "</li>" );
//  });
//       
//
//  $( "<ul/>", {
//    "class": "my-new-list",
//    html: items.join( "" )
//  }).appendTo( "#resultsList" );
//
//});
//
//
//});

$("#exit").click(function(){
        navigator.app.exitApp();
});