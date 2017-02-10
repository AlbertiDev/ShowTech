<div class="header">
	<div class="header-top">
		<div class="container">		
				<div class="col-sm-4 logo">
					<a href="index.php"><img src="images/logo.png" alt=""></a>	
				</div>
			<div class="col-sm-4 logo">
				</div>
			<div class="col-sm-4 header-left">		
					<p class="log"><a href="account.php">Login</a>
						<span>or</span><a  href="account.php"  >Signup</a></p>
					<div class="cart box_1">
						<a href="checkout.php">
						<h3>$0.00<div class="total">
							<span class="simpleCart_total"></span></div>
							<img src="images/cart.png" alt="cart"/></h3>
						</a>
						<p><a href="#" class="simpleCart_empty">Empty Cart</a></p>

					</div>
					<div class="clearfix"> </div>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
		<div class="container">
			<div class="head-top">				
			 <?php include 'menu.php'; ?>
				<div class="col-sm-2 search">		
			<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a>
		</div>
		<div class="clearfix"> </div>
			<!---pop-up-box-->
					     
					<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
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