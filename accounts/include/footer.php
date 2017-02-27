<div class="footer">	
	<div class="footer-bottom">
		<div class="container">				
				<p class="footer-class"> © 2017 Show Tech. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div>
	</div>
</div>
 <script>
 function updateSizes() {    
    var sizeString = '';
    for(var i = 1; i <= 12; i++) {
      if(jQuery('#size' + i).val() != '') {
        sizeString += jQuery('#size' + i).val() + ':' + jQuery('#qty' + i).val() + ',';
      }
    }
    jQuery('#sizes').val(sizeString);
  }

  function get_child_options(selected){
    if(typeof selected == "undefined"){var selected = '';}
   var parentID = jQuery('#parent').val();
   jQuery.ajax({
    url: '/showtech/accounts/parsers/child_ctg.php',
    type: 'POST',
    data: {parentID : parentID, selected : selected},
    success: function(data){
     jQuery('#child').html(data);
    },
     error: function(){alert("Something went wrong with the child options!");},
   });
  }
  jQuery('select[name="parent"]').change(get_child_options);
 </script>

</body>
</html>