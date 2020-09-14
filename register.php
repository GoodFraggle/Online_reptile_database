<?php
//https://www.youtube.com/watch?v=rWon2iC-cQ0&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=11
//https://www.youtube.com/watch?v=3yrpRfdtYc4&index=12&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
require_once 'core/init.php';


if(Input::exists()){
//check if input fields are set
	//echo 'Submitted';
  if(Token::check(Input::get('token'))){
    /*security check ensuring the token being submitted is the same
    as the one generated on the page*/
     
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'username' => array(
			'required'=> true,
			'min' => 2,
			'max' => 20,
			'unique' => 'users'
		),
			'password' => array(
			'required' => true,
			'min' => 6
		),
			'password_again' => array(
			'required' => true,
			'matches' => 'password'
		),
		'name' => array(
			'required' => true,
			'min' => 2,
			'max' => 50
		),
    ));
    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
		$user = new User();
		$salt = Hash::salt(32);
		try{
        //Create a new user and inserting the info in user table.
        $username = Input::get('username');
        $password = Input::get('password');
        $user->create(array(
          'username'=> Input::get('username'), 
          'password'=> Hash::make(Input::get('password'), $salt),
          'salt'=> $salt,
          'name'=> Input::get('name'),
          'joined'=>date('Y-m-d H:i:s'),
          'group'=> 1
        ));
        //Success message when account is created
        Session::put('home', 'Success, account created');
        //Log the User In
        $login = $user->login($username, $password);
        if ($login) {
          //redirect to homepage
          Redirect::to('index.php');
        }
        //redirect to the homepage after successful registration.
		}catch(Exception $e){
			die($e->getMessage());
		}
    }/*else {
      foreach ($validation->errors() as $error) {
        echo $error.' <br>';
        //displays error if any should occur.
    }
  }*/
}
}
?>
<?php include'includes/head.php'; ?>
		<title>Register</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>register</h2>
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
<form method="POST" action="">
  <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off"/>
  </div>

  <br>
  <div class="field">
    <label for="password">Password</label>
    <input type="password" name="password" id="password"   autocomplete="off"/>
  </div>

  <br>
  <div class="field">
    <label for="password_again">Confirm Password</label>
    <input type="password" name="password_again" id="password_again" autocomplete="off"/>
  </div>

  <br>
  <div class="field">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off"/>
  </div>

  <br>
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  <input type="submit" value="Register" >
</form>
</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>