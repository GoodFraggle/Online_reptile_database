<?php  require_once 'core/init.php'; ?>
<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title>View clutches</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
					<article class="main">						
						<div class="page-content">
							<div class="main-page main-page-2">
								<h3>View clutches</h3>
							<table>
								<thead>
									<tr>
										<th>Clutch number</th>
										<th>DOB</th>
										<th>Mother</th>
										<th>Father</th>
										<th> </th>
									</tr>
								</thead>
								<tbody>
									<?php
										$stmt = $pdo->query('SELECT * FROM litter');
										while($clutch = $stmt->fetch()){ ?>
											<tr>
												<td><?php echo $clutch->id;?></td>
												<td>
													<?php 
													$dateStr = $clutch->dob;
													echo date("NS F Y", strtotime($dateStr));
												 	?>
												 </td>
												<td><?php
													$con = 'SELECT * FROM animals WHERE id = :id';
													$stm = $pdo->prepare($con);
													$stm->execute(['id' => $clutch->mum]);
													$mumname = $stm->fetch();
													echo escape(ucfirst($mumname->name));
												 ?></td>
												<td><?php 
													$sq = 'SELECT * FROM animals WHERE id = :id';
													$tmt = $pdo->prepare($sq);
													$tmt->execute(['id' => $clutch->dad]);
													$dadname = $tmt->fetch();
													echo escape(ucfirst($dadname->name));
												 ?></td>
												<td><a href="<?php echo BASE_URL; ?>hatchlingList.php?link=<?php echo $clutch->id; ?>">view hatchling's/babies</a></td>
											</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>