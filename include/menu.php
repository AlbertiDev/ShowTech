<?php $sql = "SELECT * FROM categories WHERE parent = 0";
$rez = $db->query($sql);
?>
<div class="col-sm-8 h_menu4">
					<ul class="memenu skyblue">
						  <li class=" grid"><a  href="index.php">Home</a></li>
						  <?php while ($parent = mysqli_fetch_assoc($rez)) : ?>
						  	<?php 
						  		$parent_id = $parent['id'];
						  		$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
						  		$rez2 = $db->query($sql2);
						  		 ?>
					      <li><a  href="javascript:void(0)"><?php echo $parent['category']; ?></a>					      	
						      	<div class="mepanel">								
									<div class="row">
										<div class="col6">
											<div class="h_nav">
											 <?php while ($parentsm = mysqli_fetch_assoc($rez2)) : ?>									
												<ul>
													<li><a href="products.php?prod=<?=$parentsm['id'];?>&prnt=<?= $parent['category']; ?>&cld=<?=$parentsm['category'];?>"><?=$parentsm['category'];?></a></li>																						
												</ul>
											<?php endwhile; ?>	
											</div>							
										</div>								
									</div>
								</div>
						</li>
						<?php endwhile; ?>					    				
					<!-- <li><a class="color6" href="contact.php">Contact</a></li> -->
				  </ul> 
				</div>
				<div id="search" class="col-sm-4 pull-left">
					  <form action="search.php" method="post" id="custom-search-form" class="form-search form-horizontal pull-right" >
	                	<div class="input-append span12">
	                    	<input type="text" id="search" name="search" class="search-query" placeholder="Search">
	                    	<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>
	                	</div>
	            	</form>
        		</div>			    	

				
		<div class="clearfix"> </div>
			<!---pop-up-box
					   <div class="col-sm-2 search">		
			<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a>
		</div>  -->
					<!--<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>-->
					<!--<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!---//pop-up-box-->
				<!--<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
						<div class="login">
							<input type="submit" value="">
							<input type="text" value="Type something..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">		
						</div>
						<p>	Search</p>
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
				</script>-->			
	<!---->		
		</div>
	</div>
</div>