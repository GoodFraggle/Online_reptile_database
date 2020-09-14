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
		'common' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
		),
		'latin' => array(
			//'required' => true,
			'min' => 3,
			'max' => 255
		),
		'habitat_range' => array(
			//'required' => true,
			'min' => 3,
			'max' => 2000
		),
		'habitat' => array(
			//'required' => true,
			'min' => 3,
			'max' => 2000
		),
		'adult_size' => array(
			//'required' => true,
			'min' => 1,
			'max' => 255
		),
		'hatchling_size' => array(
			//'required' => true,
			'min' => 1,
			'max' => 255
		),
		'delivery' => array(
			//'required' => true,
			'min' => 3,
			'max' => 50
		),
		'comments' => array(
			//'required' => true,
			'min' => 3,
			'max' => 2000
		),
    ));

    $common = Input::get('common');
    $common = strtolower($common);
    $latin =  Input::get('latin');
	$latin = strtolower($latin);

    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
		try{
        //Create a new species and inserting the info in user table.


			$sql = 'INSERT INTO species(common, latin, habitat_range, habitat, adult_size, hatchling_size, delivery, comments)
			 VALUES(:common, :latin, :habitat_range, :habitat, :adult_size, :hatchling_size, :delivery, :comments)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['common' => $common, 'latin' => $latin, 'habitat_range' => Input::get('habitat_range'), 'habitat'=> Input::get('habitat'), 'adult_size'=> Input::get('adult_size'), 'hatchling_size'=> Input::get('hatchling_size'), 'delivery'=> Input::get('delivery'), 'comments'=> Input::get('comments') ]);

			$id = $pdo->lastInsertId();
								 
			//Print out the result for example purposes.
			// echo 'The ID of the last inserted row was: ' . $id;
			
			$sql = 'INSERT INTO morphs(morph, gene, speciesId)
			 VALUES( :morph, :gene, :speciesId)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['morph'=> Input::get('morph'), 'gene'=> Input::get('gene'), 'speciesId'=> $id]);
 
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

<!DOCTYPE html>
	<?php include'includes/head.php';?>
		<title>Add Species</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-2">
						<div id="middle" >
							<div class="add-species-left">
								<form action="" method="POST" autocomplete="off">
									<fieldset>
										<legend>Species info</legend>
										<div class="form-2-collums form-2-1">
											<label for="common">
												<input type="text" name="common" id="common" placeholder="Common name" value="<?php echo escape(Input::get('common'));?>">
											</label>
											<label for="latin">
												<input type="text" name="latin" id="latin"  value="<?php echo escape(Input::get('latin'));?>" placeholder="Latin name">
											</label>
											<label for="adult_size">
												<input type="text" name="adult_size" id="adult_size" value="<?php echo escape(Input::get('adult_size'));?>" placeholder="Adult size">
											</label>
											<label for="hatchling_size">
												<input type="text" name="hatchling_size" id="hatchling_size" placeholder="Hatchling size" value="<?php echo escape(Input::get('hatchling_size'));?>" placeholder="Hatchling size">
											</label>

											<label for="delivery">
												<select id="delivery" id="delivery" name="delivery">
												  <option value="">Choose birthing type</option>
												  <option value="egg">Egg</option>
												  <option value="live">Live</option>
												</select>
											</label>
											<label for="habitat_range">
												<textarea name="habitat_range" placeholder="Habitat range" id="habitat_range" value=<?php echo escape(Input::get('habitat_range'));?> ></textarea>
											</label>
											<label for="habitat_type">
												<textarea name="habitat" placeholder="Habitat" id="habitat" value=<?php echo escape(Input::get('habitat'));?> ></textarea>
											</label>
											
											<label for="comments">
												<textarea name="comments" placeholder="Add your comments?" id="comments" value=<?php echo escape(Input::get('comments'));?> ></textarea>
											</label>
										</div>
										<input type="hidden" name="morph" value="Normal/Wild type">
										<input type="hidden" name="gene" value="+">
										<input type="submit" value="Add species" >
									</fieldset>	
								</form>
							</div>
						</div>
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>		
