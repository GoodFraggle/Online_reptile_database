<?php  
require_once 'core/init.php';
$user = new User();
// redirecting anyone who isent logged in
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}


// redirects anyone if no animal id link in URL
if(!isset($_GET['link'])){
	header('Location: ' . BASE_URL . 'index.php');
	die();
}else{
	//check if input fields are set
	if(Input::exists()){	
	    $validate = new Validate();
	    $validation = $validate->check($_POST, array(
		'status' => array(
		'max' => 255,
		), 	
	));	
		$Name     = $_FILES['image']['name'];
	    $tempname = $_FILES['image']['tmp_name'];
	    $Type     = $_FILES['image']['type'];
	    $Size     = $_FILES['image']['size'];
	    $Error    = $_FILES['image']['error'];
		$allowed  = array('jpg', 'jpeg', 'png');
		$fileExt  = explode('.',$Name);
		$fileExt  = strtolower(end($fileExt));//$fileActualExt

		if (in_array($fileExt, $allowed)){
			if ($Error === 0) {
				if($imageSize < 10000000) {	

					$animal_id = $_GET['link'];//animal id
					$user = new User(); 
					$user_id = escape($user->data()->id);	
					//Off to the rezise function in the functions file//			
					resize_image($tempname,"1200");
					//get speciesId from newAnimals where $animal_id = id
					$sql = 'SELECT * FROM animals WHERE id = :id';
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['id' => $animal_id]);
					$comm = $stmt->fetch();

					$speciesid = $comm->speciesId;
					$morph = $comm->morph;
					$double_gene = $comm->doubleMorph;
					$locality = $comm->locality;
					$mixed_locality = $comm->mixedLocality;

					//get common and latin from species where id = speciesId 
					$sql = 'SELECT * FROM species WHERE id = :id';
					$stm = $pdo->prepare($sql);
					$stm->execute(['id' => $speciesid]);
					$com = $stm->fetch();

					//setting variables from result  
					$co = $com->common;
					$la = $com->latin;

					$co = preg_replace('/[ ,]+/', '-', trim($co));
					$la = preg_replace('/[ ,]+/', '-', trim($la));

					//building the file name i want for the image names  //
					$imagename = ucfirst($morph) . "_" . ucfirst($co) . "(" . ucfirst($la) . ")" . time() . "." . $fileExt;

					//Setting the image imageDestination path
					$imageDestination = 'uploads/amimal_images/' . $imagename;
				
					 // $thumb = $tempname;
					if(isset($_POST['submit'])){
						if($validation->passed()){
							try{							
								move_uploaded_file($tempname, $imageDestination);

								// first attempt to upload image with new name to the file location
								$sq = 'INSERT INTO images(image_address, animalid, speciesid, morph, double_gene, locality, mixed_locality, status, added_by_user_id, image) VALUES(:image_address, :animalid, :speciesid, :morph, :double_gene, :locality, :mixed_locality, :status, :added_by_user_id, :image)';
								$st = $pdo->prepare($sq);
								$st->execute(['image_address' =>  $imageDestination, 'animalid' =>  $animal_id, 'speciesid' => $speciesid, 'morph' => $morph, 'double_gene' => $double_gene, 'locality' => $locality, 'mixed_locality' => $mixed_locality,	'status' => Input::get('status'), 'added_by_user_id' => $user_id, 'image' => $imagename]);
								echo 'Post Added';
								
								// header('Location: ' . BASE_URL . '/AddingAPhoto.php');
								// header('Location: ' . BASE_URL . '/admin/imageuploads.php?link=$animalid');
								// die();
								// if(!$insertImage){
								//        echo "Prepare failed: (". $pdo->errno.") ".$pdo->error."<br>";
								//     }
	
							}catch(Exception $e){
								die($e->getMessage());
							}
						}
					}else {
						foreach ($validation->errors() as $error) {
							echo $error.' <br>';
							//displays error if any should occur.
						}
					}

				} else {
					echo "Your file was too big!";
				}
			} else {
				echo "There was a error uploading your file!";
			}
		} else {
			echo "You cannot upload files of this type!";
		}
	}	
}	
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
								<fieldset>
									<legend>Photo's</legend>
									<label for="photo's">
										<input type="file" name="image">
									</label>
									<label for="status">
										<select id="status" name="status">
											<option value=""> Choose the status </option>
											<option value="public"> Public </option>	
											<option value="private"> Private </option>
										</select>
									</label>
									<button type="submit" name="submit">Upload </button><br><br>
										<div>
											<table>
												<thead>
													<tr>
														<th>Morph</th>
														<th>Common name</th>
														<th>Latin name</th>
														<th>Added by</th>
														<th>Added on</th>
														<th>Photo</th>
												</thead>
												<tbody>
														<?php
														//header("Content-type: image/jpg");
														 $image = DB::getInstance()->query("SELECT * FROM images");
														foreach($image->results() as $image){ 
														?>
													<tr>
														 <td><?php echo ucfirst($image->morph);?></td>
														<td>							
															<?php
																$common = $image->speciesid;
																$sql = 'SELECT * FROM species WHERE id = :id';
																$stmt = $pdo->prepare($sql);
																$stmt->execute(['id' => $common]);
																$comm = $stmt->fetch();
																//The ucfirst() function converts the first character of a string to uppercase
																echo ucfirst($comm->common);
															?>
														</td>
														<td> 
															<?php echo ucfirst($comm->latin);?>
														</td>
														  <td> 
															<?php
																$user = $image->added_by_user_id;
																$sql = 'SELECT * FROM users WHERE id = :id';
																$stmt = $pdo->prepare($sql);
																$stmt->execute(['id' => $user]);
																$username = $stmt->fetch();
																//The ucfirst() function converts the first character of a string to uppercase
																echo $username->username;
															 ?>	
														</td>
														<td> 
															<?php 
																$dateStr = $image->timedate_added;
																$date = new DateTime(eval('return \'' . $dateStr . '\';'));
																echo $date->format('l jS F Y <\b\r> \a\t\ g:i A');
															?>
														</td>
														<td class="resizeImage"> 
															<?php 							
																$pic = escape($image->image_address);
																$thumb = $pic;
																echo '<a " href="' . $pic . '" ><img class="img" src="'. $thumb . '" alt=" A Image" /></a>';
															?>
														</td>
													</tr>
													<?php } ?>	
												</tbody>
											</table>
										</div>
								</fieldset>
							</form>	
						</div>					
					</div>
					</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>