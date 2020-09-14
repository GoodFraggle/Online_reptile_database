<?php
require_once 'core/init.php';

//check if input fields are set
if(Input::exists()){

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
    	'name' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
		),
		'morph' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
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
			'max' => 255,
		),
		'price' => array(
			'min' => 1,
			'max' => 50,
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

    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
    	$addanimal = new Animal();
		try{
        //Create a new user and inserting the info in user table.
        $addanimal->addanimal(array(
        	'name'=> Input::get('name'),
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
		<title><---Bad Fraggle's Reptiles---></title>
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
							<form action="" method="POST" 
							autocomplete="off">
							
								<fieldset>
									<legend>Animal Info</legend>

									<label for="name">
										Name
										<input type="text" name="name" id="name">
									</label>

									<label for="speciesId">
									Species
									<select id="speciesId" name="speciesId">
									<?php 
									$speci = DB::getInstance()->query("SELECT * FROM species");
									foreach($speci->results() as $speci){?> 
										<option value="<?echo $speci->id; ?>"><?php echo $speci->common,  "&nbsp;&nbsp;&nbsp;" . $speci->latin; ?></option>
									<?php } ?>				
									</select>
									</label>
									<label for="morph">
									Morph
									<input type="text" name="morph" id="morph">
									</label>
									<label for="dob">
									Date of Birth
									//day
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
								<input type="submit" value="Add">
							</form>
							</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>