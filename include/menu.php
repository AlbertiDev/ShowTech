<?php $sql = "SELECT * FROM categories WHERE parent = 0";
$rez = $db->query($sql);
?>
<div class="col-sm-10 h_menu4">
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
													<li><a href="products.php"><?php echo $parentsm['category']; ?></a></li>																						
												</ul>
											<?php endwhile; ?>	
											</div>							
										</div>								
									</div>
								</div>
						</li>
						<?php endwhile; ?>					    				
					<li><a class="color6" href="contact.php">Contact</a></li>
				  </ul> 
				</div>