<?php //https://www.youtube.com/watch?v=AtivJV-kx5c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=16
	require_once 'core/init.php';
	$mess = NULL;
	if(Input::exists()){
		//checks if input fields are set
		if(Token::check(Input::get('token'))){
			/*checks if security token generated on the page matches the one
			being submitted*/
			//Create rules for the fields being submitted on page
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array('required' => true),
				'password' => array('required'=> true)
				));
			if($validation->passed()){
				//log user in when validation passes
				$user = new User();
	
				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);
				if($login){
					//redirect to home page
					Redirect::to('user-index.php');
				}else{
					$mess = 'cant login';
					 
				}
			}else{
				foreach ($validation->errors() as $error) {
					echo $error, '</br>';
				}
			}
		}
	}
?>
<?php include'includes/head.php'; ?>
		<title>Login</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					
					<div class="main-page main-page-2">
<form action="" method="POST">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" autocomplete="off">
	</div>
<br>
	<div class="field">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" autocomplete="off">
	</div>
	<br>
	
<?php	
if(Input::exists()){
				foreach ($validation->errors() as $error) {
					echo $error, '</br>';
				}
			echo $mess;
			}
?>
	<br>
	<div class="field">
		<label for="remember">
			<input type="checkbox" name="remember" id="remember" autocomplete="off"> Remember Me
		</label>
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Log in">
</form>
<div>
	<p>Don't have an account? </p> <a href="register.php">Create New Account</a>
</div>
</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>