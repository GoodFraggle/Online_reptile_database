<?php  require_once 'core/init.php'; 
$user = new User();
if(!$user->hasPermission('admin')){
	Redirect::to('index.php');
}?>
<!DOCTYPE html>
<?php include'includes/head.php';?>
		<title>Admin Home Page</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Admin Home Page</h2>
						</div>
					</div>
					<div class="main-page main-page-2">
						<ul>
				            <li><a href="AddingAAnimal.php">Add a animal</a></li>
				            <li><a href="viewclutches.php">View clutch</a></li>
				            <li><a href="AddingAClutch.php">Add a clutch</a></li>
				            <li><a href="AddingPhotos.php">Add photo's to collction</a></li>
				            <li><a href="viewclutches.php">Add photo's to hatchlings</a></li>
				            <li><p></p></li>
				            <li><a href="formtesting.php">formtesting</a></li>
				        </ul> 
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>