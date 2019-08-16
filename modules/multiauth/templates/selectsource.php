<?php
/*
if (strlen($this->data['username']) > 0) {
    $this->data['autofocus'] = 'password';
} else {
    $this->data['autofocus'] = 'username';
}
*/

$this->includeAtTemplateBase('includes/scicloud_header.php');

?>

<div>
  
	<div class="scilogin-inn multipage">
		
		<div class="mylogo"><img src="https://signup.opensocial.me/static/images/opensocial.png"></div>

		<div class="login-dialog">

			<div class="login-dialog-lefts">
				<span class="title">Sign-up / Sign-in With:</span>
				<div class="login_button_container">
					<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
						<input type="hidden" name="AuthState" value="<?php echo htmlspecialchars($this->data['authstate']); ?>" />
						<?php
							foreach($this->data['sources'] as $source) {
								$name = 'src-' . base64_encode($source['source']);
								if ($source['source'] != 'example-sqlss') {
									if ($source['source']	== 'linkedin') {
										echo '<button id="login_button_linkedin" class="btn btn-block btn-social btn-linkedin btn-margin" type="submit" name="'.htmlspecialchars($name).'"><span class="fa fa-linkedin"></span> Sign-in with LinkedIn</button>';
									}
									elseif ($source['source'] == 'genericFacebookTest') {
										echo '<button id="login_button_facebook" class="btn btn-block btn-social btn-facebook btn-margin" type="submit" name="'.htmlspecialchars($name).'"><span class="fa fa-facebook"></span> Sign-in with Facebook</button>';
									}
									elseif ($source['source'] == 'genericGoogleTest') {
										echo '<button id="login_button_google" class="btn btn-block btn-social btn-google btn-margin" type="submit" name="'.htmlspecialchars($name).'"><span class="fa fa-google"></span> Sign-in with Google</button>';
									}
									else {
										echo '<button id="login_button_sqldata" class="btn btn-block btn-social btn-opensocial btn-margin" type="submit" name="'.htmlspecialchars($name).'"><span class="fa fa-user-circle-o"></span> Sign-in with OpenSocial</button>';
									}
								}
							}
						?>
					</form>
					</div>
			</div>
			<!--
			<div class="login-dialog-right">
				<div class="title">Sign-in:</span><i class="msg"></i></div>
				<form action="/simplesaml/module.php/core/loginuserpass.php?AuthState=<?php echo htmlspecialchars($this->data['authstate']);?>" method="post" name="f" id="login-form" role="form">
					<div class="form-group">
						<input id="username" name="username" placeholder="yours@example.com" class="form-control" required="true" value="" type="text">
					</div>
					<div class="form-group">
						<input id="password" name="password" placeholder="your password" class="form-control" required="true" value="" type="password">
					</div>
					<input type="hidden" name="AuthState" value="<?php echo htmlspecialchars($this->data['authstate']); ?>" />
					<div class="form-group">
						<button type="submit" name="btnSigninSubmit" id="btnSigninSubmit" value="1" class="form-control btn btn-linkedin">Sign In</button>
					</div>
					<div class="scicloud scicloud-link-container">Not a member? <a id="linkRegister" href="https://signup.opensocial.me/?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Register</a></div>
					<div class="scicloud scicloud-link-container"><a id="linkForgotPassword" href="https://signup.opensocial.me/forgotpass?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Forgot Password?</a></div>
				</form>
			</div>-->

		</div>

		<div class="content-login-dialog-below">
			<div>&copy; <?php echo date("Y"); ?> All Rights Reserved by <a href="https://www.lablynx.com/" title="LabLynx, Inc." target="_new">LabLynx, Inc.</a></div>
			<div><a href="https://www.lablynx.com/terms-of-use/" title="Terms of Use" target="_new">Terms of Use</a> | <a href="https://www.lablynx.com/privacy-statement/" title="Privacy Statement" target="_new">Privacy Statement</a></div>
		</div>

	</div>