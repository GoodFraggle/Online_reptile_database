<?php
require_once 'core/init.php';
$user = new User();
if(!$user->hasPermission('admin')){
	Redirect::to('index.php');
}
if(Input::exists()){
//check if input fields are set
	//echo 'Submitted';
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
    	'name' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
		),
		'morph' => array(
			'required'=> true,
			'max' => 255,
		),
		'doubleMorph' => array(
			'max' => 255,
		),
		'locality' => array(
			'max' => 255,
		),
		'mixedLocality' => array(
			'max' => 255,
		),
		'dob' => array(
			'max' => 255,
		),
		'purF' => array(
			'max' => 255,
		),
		'purD' => array(
			'max' => 255,
		),
		'sex' => array(
			'required'=> true,
		),
		'breeder' => array(
			'min' => 3,
			'max' => 255,
		),
		'speciesId' => array(
			'required'=> true,
		),
		'status' => array(
			'max' => 255,
		),
		'vivNo' => array(
			'required'=> true,
		),
		'sex' => array(
			'required'=> true,
		),
		'comments' => array(
			'min' => 3,
			'max' => 2000,
		),
		
    ));
   
	$dobDay = Input::get('dobDay');
    $dobMonth = Input::get('dobMonth');
    $dobYear = Input::get('dobYear');
    $purDDay = Input::get('purDDay');
    $purDMonth = Input::get('purDMonth');
    $purDYear = Input::get('purDYear');
    $dob = $dobDay . '-' . $dobMonth . '-' . $dobYear;
	$purD = $purDDay . '-' . $purDMonth . '-' . $purDYear;
    /*Validation checks Dor the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
		try{
	        //Create a new user and inserting the info in user table.

			$sql = 'INSERT INTO animals(name, morph, doubleMorph, locality, mixedLocality, dob, purF, purD, breeder, speciesId, status, vivNo, sex, comments) VALUES(:name, :morph, :doubleMorph, :locality, :mixedLocality, :dob, :purF, :purD, :breeder, :speciesId, :status, :vivNo, :sex, :comments)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['name'=> Input::get('name'), 'morph'=> Input::get('morph'), 'doubleMorph'=> Input::get('doubleMorph'), 'locality'=> Input::get('locality'), 'mixedLocality'=> Input::get('mixedLocality'), 'dob' => $dob, 'purF'=> Input::get('purF'), 'purD'=> $purD, 'breeder'=> Input::get('breeder'), 'speciesId'=> Input::get('speciesId'), 'status' => Input::get('status'), 'vivNo'=> Input::get('vivNo'), 'sex'=> Input::get('sex'), 'comments'=> Input::get('comments') ]);

	        //Success message when animal is created
	        Redirect::to('AddingPhotos.php');        
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
		<title>Add a single animal to your collection.</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-2">
						<form action="" method="POST" autocomplete="off">
							<fieldset>
								<label for="name">
									<input type="text" name="name" id="name" placeholder="Name">
								</label>
								<label for="speciesId">
									<select id="speciesId" name="speciesId">
										<option> Choose a species </option>
										<?php 
											$speci = DB::getInstance()->query("SELECT * FROM species");
											foreach($speci->results() as $speci){?> 
												<option value="<?php echo $speci->id; ?>"><?php echo $speci->common,  "&nbsp;&nbsp;&nbsp;" . $speci->latin; ?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="morph">
									<select id="morph" name="morph">
										<option value=""> Morph </option>
										<?php 
											$morph = DB::getInstance()->query("SELECT * FROM morphs");
											foreach($morph->results() as $morph){?> 
												<option value="<?php echo $morph->id; ?>"><?php echo $morph->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="doubleMorph">
									<select id="doubleMorph" name="doubleMorph">
										<option value=""> Morph with 2 gene's </option>
										<?php 
											$doubleMorph = DB::getInstance()->query("SELECT * FROM double_gene");
											foreach($doubleMorph->results() as $doubleMorph){?> 
												<option value="<?php echo $doubleMorph->id; ?>"><?php echo $doubleMorph->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="locality">
									
									<select id="locality" name="locality">
										<option value=""> Locality </option>
										<?php 
											$locality = DB::getInstance()->query("SELECT * FROM locality");
											foreach($locality->results() as $locality){?> 
												<option value="<?php echo $locality->id; ?>"><?php echo $locality->name;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="mixedLocality">
									<select id="mixedLocality" name="mixedLocality">
										<option value=""> Mixed Locality </option>
										<?php 
											$mixedLocality = DB::getInstance()->query("SELECT * FROM mixed_locality");
											foreach($mixedLocality->results() as $mixedLocality){?> 
												<option value="<?php echo $mixedLocality->id; ?>"><?php echo $mixedLocality->name;?></option>
										<?php } ?>				
									</select>
								</label>

								<label for="status">
									<select id="status" name="status">
										<option value=""> Choose the status </option>
										<option value="Hold"> Hold back </option>	
										<option value="breed"> Breeding </option>	
										<option value="sale"> Forsale </option>				
									</select>
								</label>

							    <!-- <label for="status">
									Hold back <input type="checkbox" name="holdback" value="Hold">
									Breeding <input type="checkbox" name="breed" value="breed"> 
									Forsale <input type="checkbox" name="sale" value="sale"> 
								</label> -->
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
								</label>
								<label for="sex">
									<select id="sex" name="sex">
										<option value=""> Choose the sex </option>
										<option value="male"> Male </option>	
										<option value="female"> Female </option>		
										<option value="not sexed"> Not sexed </option>			
									</select>
								</label>
								<label for="breeder">
									<input type="text" name="breeder" id="breeder" placeholder="Breeder">
								</label>
								<label for="vivNo">
									<input type="text" name="vivNo" id="vivNo" placeholder="Viv/Tub/Draw NO">
								</label>
								<label for="purF">
									<input type="text" name="purF" id="purF" placeholder="Purchased From">
								</label>
								<label for="purD">
									Perchase Date
									<?php 
										//day
										echo '<select id="purDDay" name="purDDay">';
										for($i = 1; $i <= 31; $i++){
											echo "<option value=\"$i\">$i</option>";
										}   
										echo '</select>';
										
										//month
										echo '<select id="purDMonth" name="purDMonth">';
										for($i = 1; $i <= 12; $i++){
											$dt = DateTime::createFromFormat('!m', $i);
											echo "<option value=\"$i\">".$dt->format('F n')."</option>";
										}
										echo '</select>';
										
										//year
										echo '<select id="purDYear" name="purDYear">';
										for($i = date('Y'); $i >= date('Y', strtotime('-30 years')); $i--){
										  echo "<option value=\"$i\">$i</option>";
										} 
										echo '</select>';
									?>
								</label>
								<label for="comments">
									<textarea name="comments" id="comments" placeholder="Please enter your comments here!!!"></textarea>
								</label>
								<input type="submit" value="Add">
							</fieldset>
						</form>
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>

				 