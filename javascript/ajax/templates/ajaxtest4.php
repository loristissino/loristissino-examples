<?php

$jqcode .= '

  var timer;
  
  var value="";
  $("#stopButton").hide();
  
  function updateValue() {
    $.ajax("extra/random.php")
      .done(function(data) {
        //value=data;
        values = JSON.parse(data);
        value = values[0];
      })
      .fail(function() {
        value="Unsuccessful request";
      })
    $("#thecontent").text(value);
  }
  
  $("#startButton").click(function(){
    value="Starting updates...";
    $("#thecontent").text(value);
    timer = setInterval(updateValue, 1000);
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

<h2>Ajax Test 4</h2>

<p id="thecontent">Not started</p>

<input type="button" id="startButton" value="Start" />
<input type="button" id="stopButton" value="Stop" />

