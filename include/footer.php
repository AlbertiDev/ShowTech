<div class="footer">	
	<div class="footer-bottom">
		<div class="container">				
				<p class="footer-class"> © 2017 Show Tech. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div>
	</div>
</div>

<script>
	function detailsmodal(id){
		var data = {"id":id};
		jQuery.ajax({
			url : '/showtech/include/details.php',
			method : "post",
			data : data,
			success : function (data) {
				jQuery('body').append(data);
				jQuery('#details-md').modal('toggle');
			},
			error : function () {
				alert("error 404");
			}
		});
	}

	function add_to_cart() {
		jQuery('#modal_errors').html("");
		var size = jQuery('#size').val();
		var quantity = jQuery('#quantity').val();
		var available = jQuery('#available').val();
		var error = '';
		var data = jQuery('#add_product_form').serialize();
		if (size == '' || quantity == '' || quantity == 0) {
			error += '<p class="text-danger text-center">You most choose size and quantity.</p>';
			jQuery('#modal_errors').html(error);
			return;
		}else if(quantity > available){
			error += '<p class="text-danger text-center">There are only '+available+' available</p>';
			jQuery('#modal_errors').html(error);
			return;
		}else{
			jQuery.ajax({
			url : '/showtech/include/add_to_cart.php',
			method : "post",
			data : data,
			success : function () {
				location.reload();
			},
			error : function () {
				alert("error 404");
			}
		});
		}
	}
</script>

</body>
</html>