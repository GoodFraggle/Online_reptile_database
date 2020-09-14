<?php
//https://www.youtube.com/watch?v=BiTG6AqNWEs&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=23
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}


/*if(!$username = Input::get('user')){
	Redirect::to('index.php');
}else{
	$user = new User($username);
	if(!$user->exists()){
		Redirect::to(404);
	}else{
		$data = $user->data();
	}*/
	?>
<?php include'includes/head.php'; ?>

		<title>Profile</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Profile</h2>
						</div>
						<div class="page-content">
						</div>
					</div>
					<div class="main-page main-page-2">

	<h3><?php $user = new User(); echo escape($user->data()->username); ?></h3>
	<p>Full name: <?php $user = new User(); echo escape($user->data()->name); ?></p>

</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>