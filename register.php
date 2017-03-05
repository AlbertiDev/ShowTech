<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';?>
</div>
</div>
<div class="container">
	<div class="register">
		<h1>Register</h1>
		  	  <form action="" method="post"> 
				 <div class="col-md-6  register-top-grid">
					
					<div class="mation">
						<span>Full Name</span>
						<input type="text"> 
					 
						 <span>Email Address</span>
						 <input type="email"> 
					</div>
					 <div class="clearfix"> </div>
					   <!-- <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up</label>
					   </a> -->
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>Password</span>
								<input type="password">
								<span>Confirm Password</span>
								<input type="password">
							</div>
					 </div>
					 <div class="clearfix"> </div>
				</form>
				
				<div class="register-but">
				   <form>
					   <input type="submit" value="submit" style="text-transform: uppercase">
					   <div class="clearfix"> </div>
				   </form>
				</div>
		   </div>
</div>

<?php include 'include/footer.php';?>