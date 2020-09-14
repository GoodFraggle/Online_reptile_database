<?php  
require_once 'core/init.php';

?>
<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title>Add your photo</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
					<article class="main">						
						<div class="page-content">
							<div class="main-page main-page-2">
								<h3>Add your photo</h3>
							<form action="" method="POST" enctype="multipart/form-data">
							<?php
								if(empty(Input::get('morph')) && empty(Input::get('doubleMorph')) && empty(Input::get('locality')) && empty(Input::get('mixedLocality'))) {
									echo 'Nothing selected ';
								 } 
								// } elseif(empty(Input::get('morph')) && empty(Input::get('morph'))) {
								// 	//set morph to wildtype
								
							?>
								<label for="morph"><?php $speciesId = '24'; ?>
									<select id="morph" name="morph">
										<option value=""> Select here for a single gene morph</option>
										<?php 
											$sql = 'SELECT * FROM morphs WHERE speciesId = :speciesId';
										    $stmt = $pdo->prepare($sql);
										    $stmt->execute(['speciesId' => $speciesId]);
										    $posts = $stmt->fetchAll();
											foreach($posts as $post) { ?> 
												<option value="<?php echo $post->id; ?>"><?php echo $post->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="doubleMorph">
									<select id="doubleMorph" name="doubleMorph">
										<option value="">Select here for A multi gene morph</option>
										<?php 
											$sql = 'SELECT * FROM double_gene WHERE speciesId = :speciesId';
										    $stmt = $pdo->prepare($sql);
										    $stmt->execute(['speciesId' => $speciesId]);
										    $posts = $stmt->fetchAll();
											foreach($posts as $post) { ?> 
												<option value="<?php echo $post->id; ?>"><?php echo $post->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="locality">
									<select id="locality" name="locality">
										<option value=""> Select here for regional Locality</option>
										<?php 
											$sql = 'SELECT * FROM locality WHERE speciesId = :speciesId';
										    $stmt = $pdo->prepare($sql);
										    $stmt->execute(['speciesId' => $speciesId]);
										    $posts = $stmt->fetchAll();
											foreach($posts as $post) { ?> 
												<option value="<?php echo $post->id; ?>"><?php echo $post->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="mixedLocality">
									<select id="mixedLocality" name="mixedLocality">
										<option value=""> Select here for A mixed regional Locality animal</option>
										<?php 
											$sql = 'SELECT * FROM mixed_locality WHERE speciesId = :speciesId';
										    $stmt = $pdo->prepare($sql);
										    $stmt->execute(['speciesId' => $speciesId]);
										    $posts = $stmt->fetchAll();
											foreach($posts as $post) { ?> 
												<option value="<?php echo $post->id; ?>"><?php echo $post->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<input type="submit" value="Add">
							</form>	
						</div>					
					</div>
					</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>