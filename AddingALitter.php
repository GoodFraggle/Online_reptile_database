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
		'morph' => array(
			'required'=> true,
			'min' => 3,
			'max' => 50,
		),
		'sex' => array(
			'required'=> true,
		),
		'speciesId' => array(
			'required'=> true,
		),
		'comments' => array(
			'required'=> true,
			'min' => 3,
			'max' => 2000,
		),
		'breeder' => array(
			'min' => 3,
			'max' => 50,
		),
		'price' => array(
			'min' => 3,
			'max' => 50,
		),	
		
    ));
    $dobDay = Input::get('dobDay');
    $dobMonth = Input::get('dobMonth');
    $dobYear = Input::get('dobYear');
    $purDDay = Input::get('purDDay');
    $purDMonth = Input::get('purDMonth');
    $purDYear = Input::get('purDYear');
    $dob = $dobDay . $dobMonth . $dobYear;
	$purD = $purDDay . $purDMonth . $purDYear;

    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
    	$addanimal = new Animal();
		try{
        //Create a new user and inserting the info in user table.
        $addanimal->addanimal(array(
        	'morph'=> Input::get('morph'),
        	'dob' => $dob,
        	'purD' => $purD,
        	'purF'=> Input::get('purF'),
        	'breeder'=> Input::get('breeder'),
			'speciesId'=> Input::get('speciesId'),
        	'mumMorph'=> Input::get('mumMorph'),
        	'dadMorph'=> Input::get('dadMorph'),
        	'mumId'=> Input::get('mumId'),
        	'dadId'=> Input::get('dadId'),
        	'status'=> Input::get('status'),
        	'price'=> Input::get('price'),
			'vivNo'=> Input::get('vivNo'),
        	'sex'=> Input::get('sex'),
        	'comments'=> Input::get('comments')
        ));
        //Success message when account is created
        Redirect::to('index.php');        
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
							<form action="AddingPhotos.php" method="POST" 
							autocomplete="off">
								<fieldset>
									<legend>Clutch Info</legend>
									<label for="hbDate">
									Hatch/Birth Date &nbsp;&nbsp;
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
									<label for="mum">
									Species
									<select id="speciesId" name="speciesId">
									<?php 
									$speci = DB::getInstance()->query("SELECT * FROM species");
									foreach($speci->results() as $speci){?> 
										<option value="<?echo $speci->id; ?>"><?php echo $speci->common,  "&nbsp;&nbsp;&nbsp;" . $speci->latin; ?></option>
									<?php } ?>				
									</select>
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
									<label for="sex">
									<input type="radio" name="sex" value="male"> Male
									<input type="radio" name="sex" value="female"> Female
									</label>
									<label for="breeder">
									Breeder
									<input type="text" name="breeder" id="breeder">
									</label>
									<label for="vivNo">
									Viv/Tub/Draw NO
									<input type="text" name="vivNo" id="vivNo">
									</label>
								</fieldset>
								<fieldset>
									<legend>Perchase Info</legend>
									<label for="purF">
									Perchase From
									<input type="text" name="purF" id="purF">
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
								</fieldset>
								<fieldset>
									<legend>Perent Info</legend>
									<label for="mumMorph">
									Mother Morph
									<input type="text" name="mumMorph" id="mumMorph">
									</label>
									<label for="dadMorph">
									Father Morph
									<input type="text" name="dadMorph" id="dadMorph">
									</label>
									<label for="mumId">
									Mother's ID
									
									<select id="mumId" name="mumId">
									<?php
									$anima = DB::getInstance()->query("SELECT * FROM newAnimals");
									foreach($anima->results() as $anim){?> 
										<option value="<?echo $anim->id; ?>"><?php echo $anim->morph,  "&nbsp;&nbsp;&nbsp;" . $anim->vivNo, "&nbsp;&nbsp;&nbsp;"  .  $anim->sex ; ?></option>
									<?php } ?>				
									</select>
									
									
									</label>
									<label for="dadId">
									Father's ID
									
									<select id="dadId" name="dadId">
									<?php  foreach($anima->results() as $anim){?> 
										<option value="<?echo $anim->id; ?>"><?php echo $anim->morph,  "&nbsp;&nbsp;&nbsp;" . $anim->vivNo, "&nbsp;&nbsp;&nbsp;"  .  $anim->sex ; ?></option>
									<?php } ?>				
									</select>
									
									</label>
									
								</fieldset>
								<fieldset>
									<legend>Selling Info</legend>
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
								<input type="submit" value="Add Litter">
							</form>
							</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>