<?php
require('includes/register.php');
include('includes/variables.php');
include('includes/title.php');
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>My Gallery<?php if(isset($title)){echo "&#8212;$title"; }?></title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="foundation-icons/foundation-icons.css" />
	<link rel="stylesheet" href="css/master.css" />
	<!--<script src="js/vendor/modernizr.js"></script>-->
</head>
<body>

	<div class="row frontWhite">
		
		
			<div class="medium-12 columns simpleHeader">
				<a class="item button logo" href="index.php">
					Armada
				</a>
			</div>
		

			<div class="medium-12 columns headerBox">
				<h2>
					Sign Up
				</h2>
			</div>

			<div class="medium-12 columns">
				<form id="signupForm" method="post" action=""> 

					<div class="row">

						<div class="large-4 columns large-centered">
							<?php if($registerError != ''){  echo "<p class='registerWarning'>$registerError</p>"; }?>
							<?php if($success){  echo "<p class='registerSuccess'>Registration Successful</p>"; }?>
						</div>

					</div>

					<div class="medium-4 columns medium-centered">
						<div class="row">

							<div class="small-12 columns">
								<input name="signupName" type="text"placeholder="Full Name" value="<?php echo $registerName; ?>"/>
							</div>


							<div class="small-12 columns">
								<input name="signupEmail" type="email" placeholder="Email" value="<?php echo $registerEmail; ?>"/>
							</div>

							<div class="small-12 columns">
								<input name="signupPass" type="password" placeholder="Password" /> 
							</div>

							<div class="small-12 columns">
								<input name="confirmPass" type="password" placeholder="Confirm Password" /> 
							</div>

							<div class="small-12 columns">
								<label class="noPointer">Where did you hear about this website?
									<select name="dropDown">
										<?php createOptions($optionsArray); ?>
									</select>
								</label>
							</div>

							<div class="medium-12 columns captcha">
								<?php echo solvemedia_get_html("1F5APDv35hA-i5FylQur4X8DUonpdEQr"); ?>
							</div>

						</div>
					</div>

					<div class="medium-2 columns medium-centered">
						<input name="signupSend" class="button" id="signupSend" type="submit" value="Register" />
					</div>


				</form>
			</div>
			

			
	</div>

	<?php include('includes/footer.php'); ?>

	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
		$(document).foundation();
	</script>
	<script src="js/main.js"></script>
</body>
</html>
