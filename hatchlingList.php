<?php  require_once 'core/init.php';
	$litterId = $_GET['link'];//litterId
	$user = new User();
	if(!$user->hasPermission('admin')){
		Redirect::to('index.php');
	}
 ?>
<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title>Hatchlings list</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
					<article class="main">						
						<div class="page-content">
							<div class="main-page main-page-2">
								<h3>Hatchlings list</h3>
							<table>
								<thead>
									<tr>
										<th>Unique Number</th>
										<th>DOB</th>
										<th>Mother</th>
										<th>Father</th>
										<th> </th>
										<th> </th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = 'SELECT * FROM littermates WHERE litterId = :litterId ORDER BY id ASC';
										$stmt = $pdo->prepare($sql);
										$stmt->execute(['litterId' => $litterId]);

										while($hatchling = $stmt->fetch()){ ?>
											<tr>
												<td><?php echo $hatchling->id; ?></td>
												<td><?php 
														$dateStr = $hatchling->dob;
														echo date("NS F Y", strtotime($dateStr));
													?>
												</td>
												<td><?php
													$con = 'SELECT * FROM animals WHERE id = :id';
													$stm = $pdo->prepare($con);
													$stm->execute(['id' => $hatchling->mum]);
													$mumname = $stm->fetch();
													echo escape(ucfirst($mumname->name));
												 ?></td>
												<td><?php 
													$sq = 'SELECT * FROM animals WHERE id = :id';
													$tmt = $pdo->prepare($sq);
													$tmt->execute(['id' => $hatchling->dad]);
													$dadname = $tmt->fetch();
													echo escape(ucfirst($dadname->name));
												 ?></td>
												<td class="resizeImage"> 
												<?php 									
													if (!empty($image->image_address)){
													$pic = escape($image->image_address);
													$thumb = $pic;
													echo '<a " href="' . $pic . '" ><img class="img" src="'. $thumb . '" alt=" A Image" /></a>';
												}else{echo'No Image yet.';}
												?>
											</td>

												<td><a href="<?php echo BASE_URL; ?>hatchlingphoto.php?link=<?php echo $hatchling->id; ?>">Add Photo's</a></td>
											</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>