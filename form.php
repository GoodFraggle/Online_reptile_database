<?php
require_once 'core/init.php';
$speci = DB::getInstance()->query("SELECT * FROM species");

/*if(!$speci->count()){
	echo 'No animal';
}else{
	foreach($speci->results() as $speci){
		echo $speci->id . '&nbsp;',  $speci->common . '&nbsp; / &nbsp;', $speci->latin . '</br>';
	}
}*/

if(Input::exists()){
/*check if input fields are set*/
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
    /*https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14*/
    if($validation->passed()){
    	$addanimal = new Animal();
		try{
        /*Create a new user and inserting the info in user table.*/
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
        /*Success message when account is created*/
        Redirect::to('index.php');        
        /*redirect to the homepage after successful registration.*/
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

$animals = $db->query("
	SELECT *
	FROM newAnimals
")->fetchALL(PDO::FETCH_ASSOC);

$species = $db->query("
	SELECT id, common, latin
	FROM species
	ORDER BY common ASC
")->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Form</title>
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<div class="container">
			<div class="box box-1">
				<header class="header"></header>
				<div class="top-side top-side-1"><h1>Bad</br>&emsp; Fraggle's</br>&emsp;&emsp; Reptiles</h1></div>
				<div class="top-side top-side-2"></div>
			</div>

			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Add Animal</h2>
						</div>
						<div class="page-content">
							<p>In sed odio interdum, tristique lacus 			laoreet, egestas erat. Ut a nulla mauris.
								Sed nec sapien fermentum,congue, lorem in ultricies dignissim, magna mauris maximus risus, a tincidunt est justo in enim. Duis id lacinia tellus, quis lobortis magna. Sed at imperdiet nulla. In pretium auctor diam in lobortis.
							</p>
						</div>
					</div>
					<div class="main-page main-page-2">
						<form action="" method="POST" autocomplete="off" class="form">
							<fieldset>
								<legend>Animal Info</legend>
								<label for="speciesId">
									<div class="title">
										Species
									</div>
									<div class="content">
										<select id="speciesId" name="speciesId">
										<?php foreach($species as $specie):?> 
											<option value="<?= $specie['id']; ?>"><?=$specie['common'] . "&nbsp;&nbsp;&nbsp;" . $specie['latin']; ?></option>
										<?php endforeach; ?>				
										</select>
									</div>	
								</label>
								<label for="morph">
									<div class="title">
										Morph
									</div>
									<div class="content">
										<input type="text" name="morph" id="morph" >
										</div>	
								</label>
								<label for="dob">
									<div class="title">
										Date of Birth
									</div>
									<div class="content">
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
									</div>		
								</label><br>
								<label for="sex">
									<div class="title">
										Sex
									</div>
									<div class="content">
										<input type="radio" name="sex" value="male"> Male
										<input type="radio" name="sex" value="female"> Female
									</div>	
								</label>
								<label for="breeder">
									<div class="title">
										Breeder
									</div>
									<div class="content">
										<input type="text" name="breeder" id="breeder">
										</div>	
								</label>
								<label for="vivNo">
									<div class="title">
										Viv/Tub/Draw NO
									</div>
									<div class="content">
										<input type="text" name="vivNo" id="vivNo">
									</div>	
								</label>
							</fieldset>
							<fieldset>
								<legend>Perchase Info</legend>
								<label for="purF">
									<div class="title">
										Perchase From
									</div>
									<div class="content">
										<input type="text" name="purF" id="purF">
									</div>		
								</label>
								<label for="purD">
									<div class="title">
										Perchase Date
									</div>
									<div class="content">
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
									</div>	
								</label>
							</fieldset>
							<fieldset>
								<legend>Perent Info</legend>
								<label for="mumMorph">
									<div class="title">
										Mother Morph
									</div>
									<div class="content">
										<input type="text" name="mumMorph" id="mumMorph">
									</div>
								</label>
								<label for="dadMorph">
									<div class="title">
										Father Morph
									</div>
									<div class="content">
										<input type="text" name="dadMorph" id="dadMorph">
									</div>	
								</label>
								<label for="mumId">
									<div class="title">
										Mother's ID
									</div>
									<div class="content">
										<select id="mumId" name="mumId">
											<?php foreach($animals as $animal):?> 
												<option value="<?= $animal['id']; ?>"><?=$animal['morph'] . "&nbsp;&nbsp;&nbsp;" . $animal['vivNo'] . "&nbsp;&nbsp;&nbsp;" . $animal['sex']; ?></option>
											<?php endforeach; ?>				
										</select>
									</div>	
								</label>
								<label for="dadId">
									<div class="title">
										Father's ID
									</div>
									<div class="content">
										<select id="dadId" name="dadId">
											<?php foreach($animals as $animal):?> 
											<option value="<?= $animal['id']; ?>"><?=$animal['morph'] . "&nbsp;&nbsp;&nbsp;" . $animal['vivNo'] . "&nbsp;&nbsp;&nbsp;" . $animal['sex']; ?></option>
											<?php endforeach; ?>				
										</select>
									</div>	
								</label>
							</fieldset>
							<fieldset>
								<legend>Selling Info</legend>
								<label for="sale">
									<div class="title">
										Status
									</div>
									<div class="content">
										<select id="status" name="status">
											<option value="notReady">Not ready for sale yet</option>
											<option value="forSale">For sale</option>
											<option value="forBreeding">For breeding</option>
											<option value="keepBack">Keeping back</option>
											<option value="reserved">Reserved</option>
										</select>
									</div>	
								</label>
								<label for="price">
									<div class="title">
										Price
									</div>
									<div class="content">
										<input type="text" name="price" id="price">
									</div>	
								</label>
							</fieldset>
							<fieldset>
								<label for="comments">
									<div class="title">
										Comments
									</div>	
									<div class="content">
										<textarea name="comments" id="comments"></textarea>
									</div>
								</label>
								<input type="submit" value="Add">
							</fieldset>
						</form>
					</div>
				</article>
				<aside class="aside aside-1"></aside>
				<aside class="aside aside-2"></aside>
			</div>
			<div class="box box-3">
				<footer class="footer"><p>&copy; BadFraggle.com 2019</p></footer>
				<div class="bottom-side bottom-side-1"></div>
				<div class="bottom-side bottom-side-2"></div>
			</div>
		</div>
	</body>
</html>