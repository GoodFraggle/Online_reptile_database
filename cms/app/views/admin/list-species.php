<?php require VIEW_ROOT . '/templates/header.php'; ?>
	
			<div id="middle">
				<div class="twothirds">
					<?php if (empty($species)): ?>
						<p>No species at the moment.</p>
					<?php else: ?>
						<table>
							<thead>
								<tr>
									<th>Common</th>
									<th>Latin</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($species as $specie): ?>
									<tr>
										<td><?php echo e($specie['common']);?></td>
										<td><?php echo e($specie['latin']);?></td>
										<td><a href="<?php echo BASE_URL; ?>/admin/edit-species.php?id=<?php echo e($specie['id']);?>">Edit</a></td>
										<td><a href="<?php echo BASE_URL; ?>/admin/delete-species.php?id=<?php echo e($specie['id']);?>">Delete</a></td>
										<td></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					<?php endif; ?>
					
					
				</div>
				<div class="onethird">
					<a href="<?php echo BASE_URL; ?>/admin/index.php">Back to main Admin Page</a><br>
					<a href="<?php echo BASE_URL; ?>/admin/add-species.php">Add Species</a><br>
				</div>
			</div>
<?php require VIEW_ROOT . '/templates/footer.php'; ?>