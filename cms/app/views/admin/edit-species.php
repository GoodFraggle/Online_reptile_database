<?php require VIEW_ROOT . '/templates/header.php'; ?>

	<h2>Edit Species</h2>
	<form action="<?php echo BASE_URL; ?>/admin/edit-species.php" method="POST" 
	autocomplete="off">
		<label for="common">
			Common Name
			<input type="text" name="common" id="common" value="<?php echo e($species['common']); ?>">
		</label>
		
		<label for="latin">
			Latin Name
			<input type="text" name="latin" id="latin" value="<?php echo e($species['latin']); ?>">
		</label>
		
				
		<input type="hidden" name="id" value="<?php echo e($species['id']);?>">
		
		<input type="submit" value="Edit">
	</form>
	
<?php require VIEW_ROOT . '/templates/footer.php'; ?>