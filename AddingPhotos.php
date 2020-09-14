<?php  require_once 'core/init.php'; 
$user = new User();
if(!$user->hasPermission('admin')){
	Redirect::to('index.php');
} ?>
<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title>Choose the animal</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
					<article class="main">						
						<div class="page-content">
							<div class="main-page main-page-2">
								<h3>Choose the animal you want to add a photo to</h3>
							<table>
									<thead>
										<tr>
											<th>Morph</th>
											<th>Sex</th>
											<th>Viv number</th>
											<th>Add photo</th>
										</tr>
									</thead>
									<tbody>
										<?php $anim = DB::getInstance()->query("SELECT * FROM animals ORDER BY vivNo ASC");
										foreach($anim->results() as $anim){ 
										?>
									<tr>
										<td><?php echo $anim->name;?></td>
										<td> <?php echo $anim->sex; ?></td>
										<td> <?php echo $anim->vivNo; ?></td>
										<td><a href="<?php echo BASE_URL; ?>AddingAPhoto.php?link=<?php echo $anim->id; ?>">add Images</a></td>			
									</tr>
									<?php } ?>	
								</tbody>
							</table>
						</div>




					</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>