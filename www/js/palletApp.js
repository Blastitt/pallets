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
    
       var data;
       var queryGet =  "http://10.20.64.126/api/find.cgi?pal_id=" +
            $("#srchPalID").val() + "&pal_name=" +
            $("#srchPalName").val();
       //137.155.2.154/api/find.php?Pal_id=12345&Pal_Name=

       
       $.ajax({
        url: queryGet
    }).then(function(data) {
       alert(data);
    });

       
       
//       $.getJSON(queryGet, function(json){
//            alert("JSON Data: " + json);
//        });
       
//$.ajax({
//                url:        queryGet,
//                dataType:   "jsonp", // <== JSON-P request
//                success:    function(data){
//                    alert(queryGet); // this statement doesn't show up
//                    $.each(data.result, function(entryIndex, entry){ // <=== Note, `data.results`, not just `data`
//                        alert(entry); // <=== Or `entry.from_user` would also work (although `entry['from_user']` is just fine)
//                    });
////                    alert(userList); // <== Note I've moved this (see #2 above)
//                }
//            });

//       alert(data);

//        $.ajax({
//          url: queryGet,
//          type: "post",
//          data: tdata,
//          datatype: 'json',
//          success: function(data){
//              alert(data);
//            },
//          error:function(){
//            alert("error");   
//            }
//        });
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

function scan()
{
   cordova.plugins.barcodeScanner.scan(
        function (result) {
            if(!result.cancelled)
            {
                if(result.format == "QR_CODE")
                {
                    LoadInfoPageFromQR(result);
//                    navigator.notification.prompt("Please enter name of data",  function(input){
//                        var name = input.input1;
//                        var value = result.text;
//
//                        var data = localStorage.getItem("LocalData");
//                        console.log(data);
//                        data = JSON.parse(data);
//                        data[data.length] = [name, value];
//
//                        localStorage.setItem("LocalData", JSON.stringify(data));
//
//                        alert("Done");
//                    });
                }
            }
        },
        function (error) {
            alert("Scanning failed: " + error);
        }
   );
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
function LoadInfoPageFromQR(result){
    
    alert(result.text);   
}

$(document).on("pagebeforeshow", "#display", function() {
    $("table#allTable tbody").empty();

    var data = localStorage.getItem("LocalData");
    console.log(data);
    data = JSON.parse(data);

    var html = "";

    for(var count = 0; count < data.length; count++)
    {
        html = html + "<tr><td>" + data[count][0] + "</td><td><a href='javascript:openURL(\"" + data[count][1] + "\")'>" + data[count][1] + "</a></td></tr>";
    }

    $("table#allTable tbody").append(html).closest("table#allTable").table("refresh").trigger("create");

});

function openURL(url)
{
    window.open(url, '_blank', 'location=yes');
}

$("#exit").click(function(){
        navigator.app.exitApp();
});