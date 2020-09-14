<?php  require_once 'core/init.php'; 
$user = new User();
if($user->hasPermission('admin')){
	Redirect::to('admin-index.php');
}?>
<!DOCTYPE html>
<?php include'includes/head.php'; ?>

		<title>User Home Page</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>User Home Page</h2>
						</div>
						<div class="page-content">
							<p>User Home Page.
							</p>
						</div>
					</div>
					<div class="main-page main-page-2">
						<div class="user-main">
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							<div class="main-segment"></div>
							
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>