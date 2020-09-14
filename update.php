<?php
//https://www.youtube.com/watch?v=KL4oviBqnQk&index=20&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
require_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}
if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
				)
			));

		if($validation->passed()){
			try{
				$user->update(array(
					'name' => Input::get('name')
 					));

				Session::flash('home', 'Details updated');
				Redirect::to('index.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		}else{
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>

<?php include'includes/head.php'; ?>
		<title>Update</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Update.</h2>
						</div>
						<div class="page-content">
						</div>
					</div>
					<div class="main-page main-page-2">

<form action="update.php" method="POST">
	<div class="field">
		<label for="name">Name</label>
		<input id="name" type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
		<input type="submit" name="Update" value="Update">
		<input name="token" id="token" type="hidden" value="<?php echo Token::generate();?>">
	</div>
</form>
</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>