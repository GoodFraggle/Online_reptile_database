<?php  require_once 'core/init.php'; ?>
<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title><---Bad Fraggle's Reptiles---></title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Home Page</h2>
						</div>
						<div class="page-content">
							<p>Forsale.</p>
						</div>
					</div>
					<div class="main-page main-page-2">
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
									 $animal = DB::getInstance()->query("SELECT * FROM animals");
									foreach($animal->results() as $animal){ 
									?>
								<tr>
									 <td><?php echo ucfirst($image->morph);?></td>
									<td>							
										<?php
											$common = $animal->speciesid;
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
									<td> 
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




				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>