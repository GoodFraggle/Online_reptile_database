<?php
//https://www.youtube.com/watch?v=CmqcUJOjJzo&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=18
require_once 'core/init.php';
$user = new User();
$user->logout();
Redirect::to('index.php');
?>
</div>
<?php include'includes/head.php'; ?>
		<title>Logout</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Logout</h2>
						</div>
						<div class="page-content">
						</div>
					</div>
					<div class="main-page main-page-2">
					
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>
