<?php
require_once 'core/init.php';
$user = new User();
if(!$user->hasPermission('admin')){
	Redirect::to('index.php');
}
if(Input::exists()){
//check if input fields are set
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
			'comments' => array(
			'min' => 0,
			'max' => 2000,
		),
    ));
    $dobDay = Input::get('dobDay');
    $dobMonth = Input::get('dobMonth');
    $dobYear = Input::get('dobYear');
    $dob = $dobDay . '-' . $dobMonth . '-' . $dobYear;
    $mumid = Input::get('mum');
    $dadid = Input::get('dad');

	$mumsql = 'SELECT * FROM animals WHERE id = :id';
    $mumstmt = $pdo->prepare($mumsql);
    $mumstmt->execute(['id' => $mumid]);
    $mumpost = $mumstmt->fetch();
	$mumspec = $mumpost->speciesId;

	$dadsql = 'SELECT * FROM animals WHERE id = :id';
    $dadstmt = $pdo->prepare($dadsql);
    $dadstmt->execute(['id' => $dadid]);
    $dadpost = $dadstmt->fetch();
	$dadspec = $dadpost->speciesId;

	if ($mumspec === $dadspec){
		$hatchling = $dadspec;
	} else {
		$hatchling = $mumspec . ',' . $dadspec;
	}

	$unlucky = Input::get('unlucky');
	$size = Input::get('size');
	$newsize = $size - $unlucky;

    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
		try{
	       
			$sql = 'INSERT INTO litter(dob, incubation, size, unlucky, mum, dad, comments) VALUES(:dob, :incubation, :size, :unlucky, :mum, :dad, :comments)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['dob'=> $dob, 'incubation'=> Input::get('incubation'), 'size'=> $size, 'unlucky'=> $unlucky, 'mum'=> $mumid, 'dad'=> $dadid, 'comments'=> Input::get('comments')]);

			$litterId = $pdo->lastInsertId();

			
			for($i = 1; $i <= $newsize; $i++){
				
				$sql = 'INSERT INTO littermates(dob, litterId, mum, dad, speciesId) VALUES(:dob, :litterId, :mum, :dad, :speciesId)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['dob'=> $dob, 'litterId'=> $litterId, 'mum'=> Input::get('mum'), 'dad'=> Input::get('dad'), 'speciesId'=> $hatchling]);
			}
	        //Success message when animal is created
	        // Redirect::to('#');        
	        //redirect to the homepage after successful registration.
		}catch(Exception $e){
			die($e->getMessage());
		}
	}else {
		foreach ($validation->errors() as $error) {
			echo $error.' <br>';
			//displays error if any should occur.
		}
	}
}
?>
<?php include'includes/head.php';?>
		<title>Add Clutch</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Add Clutch</h2>
						</div>
						<div class="main-page main-page-2">
							<form action="" method="POST" autocomplete="off">
								<fieldset>
									<legend>Clutch Info</legend>
									<label for="dob">
										Date of birth
											<select id="dobDay" name="dobDay">
													<option value='01'>01</option>
													<option value='02'>02</option>
													<option value='03'>03</option>
													<option value='04'>04</option>
													<option value='05'>05</option>
													<option value='06'>06</option>
													<option value='07'>07</option>
													<option value='08'>08</option>
													<option value='09'>09</option>
													<option value='10'>10</option>
													<option value='11'>11</option>
													<option value='12'>12</option>
													<option value='13'>13</option>
													<option value='14'>14</option>
													<option value='15'>15</option>
													<option value='16'>16</option>
													<option value='17'>17</option>
													<option value='18'>18</option>
													<option value='19'>19</option>
													<option value='20'>20</option>
													<option value='21'>21</option>
													<option value='22'>22</option>
													<option value='23'>23</option>
													<option value='24'>24</option>
													<option value='25'>25</option>
													<option value='26'>26</option>
													<option value='27'>27</option>
													<option value='28'>28</option>
													<option value='29'>29</option>
													<option value='30'>30</option>
													<option value='31'>31</option>
												</select>
										<?php	
											//month
											echo '<select id="dobMonth" name="dobMonth">';
												for($i = 1; $i <= 12; $i++){
													$dt = DateTime::createFromFormat('!m', $i);
													echo "<option value=".$dt->format('m').">".$dt->format('F m')."</option>";
												}
											echo '</select>';
											//year
											echo '<select id="dobYear" name="dobYear">';
												for($i = date('Y'); $i >= date('Y', strtotime('-3 years')); $i--){
												  echo "<option value=\"$i\">$i</option>";
												} 
											echo '</select>';
										?>
									</label>
									<label for="incubation">
										Incubation time in days
										<?php
											echo '<select id="incubation" name="incubation">';
											for($i = 0; $i <= 400; $i++){
												echo "<option value=\"$i\">$i</option>";
											}   
											echo '</select>';
										?>
									</label>
									<label for="size">
										Number of young/eggs
										<?php
											echo '<select id="size" name="size">';
											for($i = 0; $i <= 400; $i++){
												echo "<option value=\"$i\">$i</option>";
											}   
											echo '</select>';
										?>
									</label>
									<label for="unlucky">
										Number of stillborn/infertile eggs
										<?php
											echo '<select id="unlucky" name="unlucky">';
											for($i = 0; $i <= 400; $i++){
												echo "<option value=\"$i\">$i</option>";
											}   
											echo '</select>';
										?>
									</label>
									<label for="mum">
										<select id="mum" name="mum">
											<option> Choose a Mother </option>
											<?php 
												$mom = DB::getInstance()->query("SELECT * FROM animals  WHERE sex = 'female'");
												foreach($mom->results() as $mom){?> 
													<option value="<?php echo $mom->id; ?>"><?php echo $mom->name; ?></option>
											<?php } ?>				
										</select>
									</label>
									<label for="dad">
										<select id="dad" name="dad">
											<option> Choose a Father </option>
											<?php 
												$pop = DB::getInstance()->query("SELECT * FROM animals  WHERE sex = 'male'");
												foreach($pop->results() as $pop){?> 
													<option value="<?php echo $pop->id; ?>"><?php echo $pop->name; ?></option>
											<?php } ?>				
										</select>
									</label>
									<label for="comments">
									Comments<br>
									<textarea name="comments" id="comments"></textarea>
								</label><br><br><br>
								<input type="submit" value="Add">
								</fieldset>
							</form>
						</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>