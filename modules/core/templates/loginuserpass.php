<?php

$this->data['header'] = $this->t('{login:user_pass_header}');
require_once('signup.php');

if (strlen($this->data['username']) > 0) {
    $this->data['autofocus'] = 'password';
} else {
    $this->data['autofocus'] = 'username';
}
$this->includeAtTemplateBase('includes/scicloud_header.php');

if (isset($client['auth_options'])) {
    $authop = explode(',',$client['auth_options']);
} else {
    $authop = '';
}

?>
  
<div class="scilogin-inn shadow">

    <div class="ribon tooltips">
        <?php 
        if (!empty($client['message_title'])) {
        ?>
        <span class="site_mode"> <?php echo $client['message_title'];?> </span>
        <?php
        }
        ?>
        <?php 
        if (!empty($client['message'])) {
        ?>
        <span class="">
            <div class="tooltiptext"><span><?php echo $client['message'];?></span></div>
        </span>
        <?php } ?>
        
    </div>

    <?php 
        if (isset($client['site_logo'])) {
            echo '<div class="mylogo">';
                echo '<a href="'.$client['identity'].'"><img src='.$client['site_logo'].'></a>';
            echo '</div>';
        } else {
            echo '<div class="client_logo">';
                echo '<a href="'.$client['identity'].'">'.parse_url($client['identity'], PHP_URL_HOST).'</a>';
            echo '</div>';
        }
    ?>

    <div class="col-md-12 inner-text">

        <?php 

        if (empty($authop) && !isset($client['email_login'])) {
            ?>
            <div class="col-md-12 inner-text">
			<div class="login-dialog-left col-md-6">
				<span class="title left-title">Sign-up / Sign-in With:</span>
				<div class="login_button_container">
                    <form action="?" method="post" name="fs" id="login-social" role="form">
                        <button id="login_button_linkedin" class="btn btn-block btn-social btn-linkedin btn-margin" type="submit" name="linkedin" source="linkedin"><span class="fa fa-linkedin"></span> Sign-in with LinkedIn</button>
                        <button id="login_button_facebook" class="btn btn-block btn-social btn-facebook btn-margin" type="submit" name="facebook"><span class="fa fa-facebook"></span> Sign-in with Facebook</button>
                        <button id="login_button_google" class="btn btn-block btn-social btn-google btn-margin" type="submit" name="google"><span class="fa fa-google"></span> Sign-in with Google</button>
                        <button id="login_button_twitter" class="btn btn-block btn-social btn-twitter btn-margin" type="submit" name="twitter"><span class="fa fa-twitter"></span> Sign-in with Twitter</button>
                        <button id="login_button_github" class="btn btn-block btn-social btn-github btn-margin" type="submit" name="gitHub"><span class="fa fa-github"></span> Sign-in with GitHub</button>
                        <?php
                            foreach ($this->data['stateparams'] as $name => $value) {
                                echo('<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" />');
                            }
                        ?>
					</form>
                </div>
			</div>

			<div class="login-dialog-right col-md-6">
				<div class="title">Sign-in:</span><i class="msg"></i></div>
                    <form action="?" method="post" name="f" id="login-form" role="form">
                        <div class="form-group">
                            <input id="username" name="username" placeholder="Email Address" <?php echo ($this->data['forceUsername']) ? 'disabled="disabled"' : ''; ?>  class="form-control" required="true" type="text" <?php if (!$this->data['forceUsername']) { echo 'tabindex="1"'; } ?> value="<?php echo htmlspecialchars($this->data['username']); ?>">
                        </div>
                        <div class="form-group" style="margin-bottom: 8px;">
                            <input id="password" name="password" placeholder="Password" class="form-control" required="true" value="" type="password" tabindex="2">
                        </div>
                        <?php
                            if ($this->data['errorcode'] !== null) {
                                echo '<div class="ralert">'.htmlspecialchars($this->t($this->data['errorcodes']['title'][$this->data['errorcode']], $this->data['errorparams'])).'</div>';
                            }
                        ?>
                        <?php
                            foreach ($this->data['stateparams'] as $name => $value) {
                                echo('<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" />');
                            }
                        ?>
                        <div class="form-group">
                            <button type="submit" name="btnSigninSubmit" id="btnSigninSubmit" value="1" class="form-control btn btn-linkedin">Sign-In</button>
                        </div>
                        <?php 
                            if ( $client['site_mode'] == 'Open' ) {
                        ?>
                            <div class="scicloud scicloud-link-container">Not a member? <a id="linkRegister" href="https://signup.opensocial.me/?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Sign-up</a></div>
                            <div class="scicloud scicloud-link-container"><a id="linkForgotPassword" href="https://signup.opensocial.me/forgotpass?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Reset Password</a></div>
                            <div class="scicloud scicloud-link-container"><a id="linkForgotPassword" href="https://signup.opensocial.me/resend?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Resend Verification</a></div>
                        <?php 
                            }
                        ?>
                    </form>
			    </div>
		    </div>
            <?php
        }
        

            if (!empty($authop)) {

                $only_social_login = !isset($client['email_login']) ? 'only-social-login' : 'login-dialog-left col-md-6';
                $only_social_login_btns = !isset($client['email_login']) ? 'only-social-login-btns' : 'login_button_container';
                
            ?>
                    
                <div class="<?php echo $only_social_login;?>">
                    <span class="title left-title">Sign-up / Sign-in With:</span>
                    <div class="<?php echo $only_social_login_btns;?>">
                        <form action="?" method="post" name="fs" id="login-social" role="form">
                            <?php    
                                foreach ($authop as $auth) {
                                    echo '<button id="login_button_'.$auth.'" class="btn btn-block btn-social btn-'.$auth.' btn-margin" type="submit" name="'.$auth.'" source="'.$auth.'"><span class="fa fa-'.$auth.'"></span> Sign-in with '.ucfirst($auth).'</button>';
                                }
                                foreach ($this->data['stateparams'] as $name => $value) {
                                    echo('<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" />');
                                }
                            ?>
                        </form>
                    </div>
                </div>
            
            <?php
            }

            if (isset($client['email_login'])) {
                $only_email_login = empty($authop) ? 'login-dialog-right onlylogin' : 'login-dialog-right col-md-6';
            ?>

            <div class="<?php echo $only_email_login;?>">
				    <div class="title">Sign-in:</span><i class="msg"></i></div>
                    <form action="?" method="post" name="f" id="login-form" role="form">
                        <div class="form-group">
                            <input id="username" name="username" placeholder="Email Address" <?php echo ($this->data['forceUsername']) ? 'disabled="disabled"' : ''; ?>  class="form-control" required="true" type="text" <?php if (!$this->data['forceUsername']) { echo 'tabindex="1"'; } ?> value="<?php echo htmlspecialchars($this->data['username']); ?>">
                        </div>
                        <div class="form-group" style="margin-bottom: 8px;">
                            <input id="password" name="password" placeholder="Password" class="form-control" required="true" value="" type="password" tabindex="2">
                        </div>
                        <?php
                            if ($this->data['errorcode'] !== null) {
                                echo '<div class="ralert">'.htmlspecialchars($this->t($this->data['errorcodes']['title'][$this->data['errorcode']], $this->data['errorparams'])).'</div>';
                            }
                        ?>
                        <?php
                            foreach ($this->data['stateparams'] as $name => $value) {
                                echo('<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" />');
                            }
                        ?>
                        <div class="form-group">
                            <button type="submit" name="btnSigninSubmit" id="btnSigninSubmit" value="1" class="form-control btn btn-linkedin">Sign-In</button>
                        </div>
                        <?php 
                            if ( $client['site_mode'] == 'Open' ) {
                        ?>
                            <div class="scicloud scicloud-link-container">Not a member? <a id="linkRegister" href="https://signup.opensocial.me/?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Sign-up</a></div>
                        <?php 
                            }
                        ?>
                        <div class="scicloud scicloud-link-container"><a id="linkForgotPassword" href="https://signup.opensocial.me/forgotpass?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Reset Password</a></div>
                        <div class="scicloud scicloud-link-container"><a id="linkForgotPassword" href="https://signup.opensocial.me/resend?AuthState=<?php echo urlencode($_GET['AuthState']); ?>">Resend Verification</a></div>
                    </form>
                </div>
            </div>
            <?php
              } 
            ?>

            <div style="margin-top: 2px; text-align: center;">
                <a href="<?php echo $client['terms'];?>">Terms of Use</a> | <a href="<?php echo $client['privacy'];?>">Privacy Statement</a>
            </div>

            <?php
                if (isset($_GET['user'])) {
                    echo '<div class="ralert" style="margin-bottom: 25px;">'.$_GET['sso_msg'].'</div>';
                }
            ?>
            
            <div class="content-login-dialog-below footer">
               <?php echo $settings[0]['site_footer'];?>
               <div style="margin-top: 10px;">Need Help? <?php echo '<a href="mailto:'.$client['help_email'].'">'.$client['help_email'];?> </div>
            </div>
            
        </div>
	</div>

    <?php
        if (isset($client['site_bg'])) {
            $bg = $client['site_bg'];
        } else {
            $bg = 'https://signup.opensocial.me/static/background/'.$settings[0]['site_background'];
        }
    ?>
        <script type="text/javascript">
            $('body').css('background-image', 'url(<?php echo $bg;?>)')
        </script>
