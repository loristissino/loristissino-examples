<?php

$jqcode .= '
  $("#changer").click(function(){
      $("#thecontent").text("A different content");
      $("#changer").val("Done!").fadeOut(3000);
  });
';
?>

<h2>Ajax Test 2</h2>

<p id="thecontent">Some content</p>

<input type="button" id="changer" value="Change content" />
