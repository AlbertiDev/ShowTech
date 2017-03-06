<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/showtech/assets/conn.php';
include 'include/head.php'; include 'include/scripts.php'; 
include 'include/header.php';?>
</div>
</div>
<div class="container">
	<div class="register">
		<h1>Register</h1>
		  	  <form action="register.php" method="post"> 
				 <div class="col-md-6  register-top-grid">
					
					<div class="mation">
						<span>Full Name</span>
						<input type="text" name="full_name" id="full_name"> 
					 
						 <span>Email Address</span>
						 <input type="email" name="email" id="email"> 
					</div>
					 <div class="clearfix"> </div>
					   <!-- <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up</label>
					   </a> -->
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>Password</span>
								<input type="password" name="password1" id="password1">
								<span>Confirm Password</span>
								<input type="password" name="password2" id="password2">
							</div>
					 </div>
					 <div class="clearfix"> </div>
				
				<div class="register-but">
				   
					   <input type="submit" value="submit" style="text-transform: uppercase">
					   <div class="clearfix"> </div>
				   
				</div>
				</form>
		   </div>
</div>

</div>
</div>
<?php include 'include/footer.php';?>