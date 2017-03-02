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
</script>

</body>
</html>