<?php

$jqcode .= '

  var timer;
  
  var value="";
  $("#stopButton").hide();
  
  function updateValue() {
    $.ajax("extra/dataprovider7.php?action=get")
      .done(function(data) {
        value = data;
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

  $("#mybutton").click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "extra/dataprovider7.php?action=update",
      data: { value: $("#myvalue").val() },
      success: function(data) {
          $("#msg").html("Updated the base, now: " + data);
        }
      });
  });

';
?>

<h2>Ajax Test 7</h2>

<p id="thecontent">Not started</p>

<input type="button" id="startButton" value="Start" />
<input type="button" id="stopButton" value="Stop" />

<hr />

<form id="myform">
  <input type="number" min="1" max="10" name="value" value="10" id="myvalue" />
  <input id="mybutton" type="submit" value="Update the base" />
  <div id="msg"></div>
</form>
