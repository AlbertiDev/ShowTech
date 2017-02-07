<div class="header">
	<div class="header-top">
		<div class="container">		
				<div class="col-sm-4 logo">
					<a href="index.php"><img src="images/logo.png" alt=""></a>	
				</div>
			<div class="col-sm-4 logo">
						
				</div>
			<div class="col-sm-4 header-left">		
					<p class="log"><a href="account.php"  >Login</a>
						<span>or</span><a  href="account.php"  >Signup</a></p>
					<div class="cart box_1">
						<a href="checkout.php">
						<h3> <div class="total">
							<span class="simpleCart_total"></span></div>
							<img src="images/cart.png" alt=""/></h3>
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

					</div>
					<div class="clearfix"> </div>
			</div>
				<div class="clearfix"> </div>
		</div>
		</div>
		<div class="container">
			<div class="head-top">				
		 <div class="col-sm-10 h_menu4">
				<ul class="memenu skyblue">
					  <li class=" grid"><a  href="index.php">Home</a></li>	
				      <li><a  href="#">Computer &amp; Office</a>
				      	<div class="mepanel">
						<div class="row">
							<div class="col1">
								<div class="h_nav">
									<h4>Tablets</h4>
									<ul>
										<li><a href="products.php">Octa Core</a></li>
										<li><a href="products.php">Quad Core</a></li>
										<li><a href="products.php">Dual Core</a></li>
										<li><a href="products.php">7-inch Screen</a></li>
										<li><a href="products.php">9-inch Screen</a></li>
										<li><a href="products.php">10-inch Screen</a></li>
																				
									</ul>	
								</div>							
							</div>
							<div class="col1">
								<div class="h_nav">
									<h4>Tablet &amp; Laptop Accessories</h4>
									<ul>
										<li><a href="products.php">Laptop Bags &amp; Cases</a></li>
										<li><a href="products.php">Laptop Batteries</a></li>
										<li><a href="products.php">Tablet Accessories</a></li>
										<li><a href="products.php">Tablet LCD Screens</a></li>
										<li><a href="products.php">Tablet Cases</a></li>
									
									</ul>	
								</div>							
							</div>
							<div class="col1">
								<div class="h_nav">
									<h4>Office Electronics</h4>
									<ul>
										<li><a href="products.php">Printer Supplies</a></li>
										<li><a href="products.php">Projectors &amp; Accessories</a></li>
										<li><a href="products.php">3D Printers</a></li>
										<li><a href="products.php">Printers</a></li>
										<li><a href="products.php">Scanners</a></li>
										<li><a href="products.php">Laser Pens</a></li>
									</ul>	
								</div>												
							</div>
						  </div>
						</div>
					</li>
				    <li class="grid"><a  href="#">Phones &amp; Accessories</a>
					  	<div class="mepanel">
						<div class="row">
							<div class="col1">
								<div class="h_nav">
									<h4>Mobile Phones</h4>
									<ul>
										<li><a href="products.php">Octa Core</a></li>
										<li><a href="products.php">Quad Core</a></li>
										<li><a href="products.php">Single SIM Card</a></li>
										<li><a href="products.php">Dual SIM Card</a></li>
										<li><a href="products.php">3GB RAM</a></li>
										<li><a href="products.php">5-inch Display</a></li>								
									</ul>	
								</div>							
							</div>
							<div class="col1">
								<div class="h_nav">
									<h4>Mobile Phone Parts</h4>
									<ul>
										<li><a href="products.php">Mobile Phone LCDs</a></li>
										<li><a href="products.php">Mobile Phone Batteries</a></li>
										<li><a href="products.php">Mobile Phone Housing</a></li>
										<li><a href="products.php">Signal Boosters</a></li>
										<li><a href="products.php">SIM Card &amp; Tools</a></li>
									
									</ul>
								</div>							
							</div>
							<div class="col1">
								<div class="h_nav">
									<h4>Phone Bags &amp; Cases</h4>
									<ul>
										<li><a href="products.php">Pouches</a></li>
										<li><a href="products.php">iPhone 7 Cases</a></li>
										<li><a href="products.php">iPhone 6 Cases</a></li>
										<li><a href="products.php">Leather Cases</a></li>
										<li><a href="products.php">Aluminum Cases</a></li>
										<li><a href="products.php">Waterproof Cases</a></li>
										<li><a href="products.php">Telephones</a></li>
										<li><a href="products.php">Telecom Parts</a></li>
									</ul>	
								</div>												
							</div>
						  </div>
						</div>
			    </li>
				<li><a  href="typo.php">Consumer Electronics</a></li>				
				<li><a class="color6" href="contact.php">Contact</a></li>
			  </ul> 
			</div>
				<div class="col-sm-2 search">		
			<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a>
		</div>
		<div class="clearfix"> </div>
			<!---pop-up-box---->
					     
					<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!---//pop-up-box---->
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