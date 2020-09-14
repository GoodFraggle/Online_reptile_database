<?php
require_once 'core/init.php';
$user = new User();
if(!$user->hasPermission('admin')){
	Redirect::to('index.php');
}?>

<?php include'includes/head.php';?>
		<title>Template</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Home Page</h2>
						</div>
						<div class="page-content">
							<p>Home Page Content.</p>
						</div>
					</div>
					<div class="main-page main-page-2">
						<h2>Add Animal</h2>
						<form action="#" method="POST" autocomplete="off">
							<fieldset>
								<legend>Animal Info</legend>

								<label for="morph">
									Morph
									<input type="text" name="morph" id="morph">
								</label>

								<label for="sex">
									<input type="radio" name="sex" value="male"> Male
									<input type="radio" name="sex" value="female"> Female
								</label>

								<label for="breeder">
									Breeder
									<input type="text" name="breeder" id="breeder">
								</label>

								<label for="dob">
									Date of Birth
									<?php 
										//day
										echo '<select id="dobDay" name="dobDay">';
										for($i = 1; $i <= 31; $i++){
											echo "<option value=\"$i\">$i</option>";
										}   
										echo '</select>';
										
										//month
										echo '<select id="dobMonth" name="dobMonth">';
										for($i = 1; $i <= 12; $i++){
											$dt = DateTime::createFromFormat('!m', $i);
											echo "<option value=\"$i\">".$dt->format('F n')."</option>";
										}
										echo '</select>';
										
										//year
										echo '<select id="dobYear" name="dobYear">';
										for($i = date('Y'); $i >= date('Y', strtotime('-30 years')); $i--){
										  echo "<option value=\"$i\">$i</option>";
										} 
										echo '</select>';
									?>
								</label><br>

								
								<label for="breeder">
								Breeder
								<input type="text" name="breeder" id="breeder">
								</label>
								
								<label for="vivNo">
								Viv/Tub/Draw NO
								<input type="text" name="vivNo" id="vivNo">
								</label>

								<label for="sale">
									Status
									 <select id="status" name="status">
										<option value="notReady">Not ready for sale yet</option>
										<option value="forSale">For sale</option>
										<option value="forBreeding">For breeding</option>
										<option value="keepBack">Keeping back</option>
										<option value="reserved">Reserved</option>
									 </select>
								</label>
								<label for="price">
									Price
									<input type="text" name="price" id="price">
								</label>
							</fieldset>

							<label for="comments">
								Comments<br>
								<textarea name="comments" id="comments"></textarea>
							</label><br><br><br>

							<input type="submit" value="Add">
						</form>
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>