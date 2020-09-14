<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Add species</title>
		
		<link rel="stylesheet" href="<?php echo BASE_URL?>/css/test.css">
	</head>
	<body>
		<div class="wrapper">
			<h1>Badfraggle</h1>
			<h2>Add species</h2>
			<div class="add-species-left">
				<form action="<?php echo BASE_URL; ?>/admin/add-species.php" method="POST" autocomplete="off">
					<label for="common">
						Common name
						<input type="text" name="common" id="common">
					</label>
					<label for="latin">
						Latin name
						<input type="text" name="latin" id="latin">
					</label>
					<input type="submit" value="Add">
				</form>
			</div>
			<div class="add-species-right">
				<ul>
				<?php foreach ($species as $specieses): ?>
					<li><?php echo $specieses['common'];?>&nbsp&nbsp&#8594;&nbsp&nbsp<?php echo $specieses['latin']; ?></li>
				<?php endforeach; ?>
				</ul>
			</div>	
		</div>
	</body>
</html>