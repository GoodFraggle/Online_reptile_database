<?php
//https://www.youtube.com/watch?v=nhAIU-p8Tk4&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=21
require_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
             'password_current'=> array(
                'required'=> true,
                'min'=> 6
             	),
             'password_new'=> array(
                'required'=> true,
                'min'=> 6
             	),
             'password_new_again'=> array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
             	)
			));

		if($validation->passed()){
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password){
				echo 'Your current password is wrong';
			}else{
				$salt = Hash::salt(32);
				$user->update(array(
					'password'=> Hash::make(Input::get('password_new'), $salt),
					'salt'=> $salt
					));
				Session::flash('home', 'Password successfully changed');
				Redirect::to('index.php');
			}
		}/*else{
			foreach ($validation->errors() as $error) {
				echo $error.'<br>';
			}
		}*/
	}
}
?>
<?php include'includes/head.php'; ?>
		<title>Change password</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Change password</h2>
						</div>
						<div class="page-content">
						</div>
					</div>
					<div class="main-page main-page-2">

					<?php 
          if(Input::exists()){
            foreach ($validation->errors() as $error) {
          echo $error.' <br>';
          //displays error if any should occur.
          echo $mess;
        }
      }
  ?>
<form action="" method="POST">
	<div class="field">
		<label for="password_current"> 
			Current Password
		</label>
		<input type="password" name="password_current"
		id="password_current">
	</div>
	<div class="field">
		<label for="password_new">
			New Password
		</label>
		<input type="password" name="password_new" id="password_new">
	</div>
	<div class="field">
		<label for="password_new_again">
			New Password Again
		</label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>
	<input type="submit" value="Update">
	<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>">
</form>
</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>