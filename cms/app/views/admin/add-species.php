<?php require VIEW_ROOT . '/templates/header.php'; ?>
			<h2>Add species</h2>
			<div id="middle" >
				<div class="add-species-left">
					<form action="<?php echo BASE_URL; ?>/admin/add-species.php" method="POST" autocomplete="off">
						<label for="common">
							Common name
							<input type="text" name="common" id="common">
						</label>
						<label for="latin">
							Latin name
							<input type="text" name="latin" id="latin">
						</label><br>
						<input type="submit" value="Add">
					</form>
				</div>
				<div class="add-species-right">
					<a href="<?php echo BASE_URL; ?>/admin/index.php">Back to main Admin Page</a><br><br><br><br>
					<ul>
					<?php foreach ($species as $specieses): ?>
						<li><?php echo $specieses['common'];?>&nbsp&nbsp&#8594;&nbsp&nbsp<?php echo $specieses['latin']; ?></li>
					<?php endforeach; ?>
					</ul>
				</div>	
			</div>
<?php require VIEW_ROOT . '/templates/footer.php'; ?>