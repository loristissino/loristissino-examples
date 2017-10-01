<?php

$jqcode .= '

    $.ajax("extra/dataprovider8.php")
      .done(function(data) {
        var rooms = JSON.parse(data);
        console.log(rooms);
        
        var maxx=0;
        var maxy=0;
        $.each(rooms, function(key, room) {
            var s;
            s = room.posx + room.sizex;
            if ( s > maxx ) maxx= s;
            s = room.posy + room.sizey;
            if ( s > maxy ) maxy= s;
        })

        var scalex = $("#map").width()*0.9 / maxx;
        var scaley = $("#map").height()*0.9 / maxy;
        
        var scale = Math.min(scalex, scaley);
        
        var offsetx = ($("#map").width() - maxx * scale) / 2;
        var offsety = ($("#map").height() - maxy * scale) / 2;

        var borderWidth = 2;

        $.each(rooms, function(key, room) {
            console.log(room.sizex * scale);
            
            $("#map").append($("<div/>").css(
                {
                    "width": Math.round(room.sizex * scale - borderWidth ),
                    "height": Math.round(room.sizey * scale - borderWidth  ),
                    "left": Math.round(room.posx * scale + offsetx),
                    "top": Math.round(room.posy * scale + offsety),
                    "background-color": room.color,
                }).addClass("room").click( function() {
                    //alert("You clicked on room " + room.id);
                    $.ajax("extra/dataprovider8a.php?id=" + room.id)
                        .done(function(data) {
                        var values = JSON.parse(data);
                        $("#info").text(values.info);
                    })
                })
            )
        })
      
      })

';
?>

<h2>Ajax Test 8</h2>

<div id="container">
    <p id="map"></div>
    <p id="info"></p>
</div>


