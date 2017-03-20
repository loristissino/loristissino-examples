<?php

$jqcode .= '

  $("#myform").submit(function() {
    $("#mybutton").hide();
    $("#ajaxloader").show();
  });
  
';
?>

<h2>Ajax Test 6</h2>

<form id="myform" action="?action=slowaction" method="POST">
  <input type="number" min="1" max="10" name="seconds" value="5" /><br />
  <input id="mybutton" type="submit" value="Process my data" />
  <div id="ajaxloader" style="display: none">
    <img src="images/ajax-loader.gif" />
    <!-- generated at http://www.ajaxload.info/ -->
    <span>Please wait: processing data...</span>
  </div>
</form>

