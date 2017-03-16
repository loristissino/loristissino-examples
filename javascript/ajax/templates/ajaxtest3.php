<?php

$jqcode .= '

  var timer;
  
  var value=0;
  $("#stopButton").hide();
  
  function updateValue() {
    $("#thecontent").text(++value);
  }
  
  $("#startButton").click(function(){
    timer = setInterval(updateValue, 200);
    $("#startButton").hide();
    $("#stopButton").show();
  });

  $("#stopButton").click(function(){
    window.clearInterval(timer);
    $("#startButton").show();
    $("#stopButton").hide();
  });

  
';
?>

<h2>Ajax Test 3</h2>

<p id="thecontent">0</p>

<input type="button" id="startButton" value="Start" />
<input type="button" id="stopButton" value="Stop" />

