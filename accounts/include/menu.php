<div class="col-sm-10 h_menu4">
						<ul class="memenu skyblue">
							  <li><a class="color6" href="view.php">View</a></li>						 		    				
							  <li><a class="color6" href="brands.php">Brands</a></li>
							  <li><a class="color6" href="categories.php">Categories</a></li>
							  <?php if (has_permissions('editor')):?>
							  	<li><a class="color6" href="products.php">Products</a></li>
							  	<li><a class="color6" href="recover.php">Recover</a></li>
							  <?php endif; ?>	
							  <?php if (has_permissions('admin')):?>
							  	<li><a class="color6"  href="users.php">Users</a></li>						 		    				
							  <?php endif; ?>	
					  	</ul> 
</div>
<div class="clearfix"> </div>
			<!---pop-up-box-->
					     
					<link href="../css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="../js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!---//pop-up-box-->
				<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
						<div class="login">
							<input type="submit" value="">
							<input type="text" value="Type something..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">		
						</div>
						<p>	Shopping</p>
					</div>				
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>			
	<!---->		
		</div>
	</div>
</div>