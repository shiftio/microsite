
$(document).ready(function() {

    // Player Key
    jwplayer.key = "d6gsi297N6N7krcFM23KX4G7XqOJJHfHfo7L/g==";

    // Listen to clicks on the thumbnails to start video playback
    $(document).on('click','.thumb-container', function(e){
        var assetid = $(this).children("img").data('assetid');
        $("#videostage").addClass("active");
        $("#videostagectrl").addClass("active");
        loadFile(assetid);
    })

    $("#videostagectrl").on("click", function(){
        $(this).removeClass('active');
//        $('#videostage').remove();
        var playerInstance = jwplayer("videoplayer");
        playerInstance.remove();
        $("#videostage").removeClass("active");

    });


    // Load an asset by specific ID

    function loadFile(assetid) {
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "/asset/" + assetid,
            "method": "GET",
            "statusCode": {
                401: function() {
                    showError(401);
                },
                404: function() {
                    showError(404);
                }
            }
        }

        $.ajax(settings).done(function(response) {
            var asset = JSON.parse(response);
            playFile(returnProxy(asset));
        })
    }

    function returnProxy(asset){
        for(var i = 0; i < asset.derivatives.length; i++){
            if(asset.derivatives[i].type === "proxy"){
                return asset.derivatives[i].url;
            }
        }
    }

    function playFile(url){
        var playerInstance = jwplayer("videoplayer");
        playerInstance.setup({
            primary: "html5",
            width: 960,
            height: 540,
            autostart: true,
            skin: "bekle",
            file: url
        });

        playerInstance.on('error', function(e) {
            showError();
        });
    }
})