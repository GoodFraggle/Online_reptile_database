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
		'name' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
		),
		'speciesId' => array(
			'required'=> true,
		),
		'locality' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
		),
		'adult_size' => array(
			'required'=> true,
			'min' => 3,
			'max' => 255,
		),
		'hatchling_size' => array(
			'required' => true,
			
		),		
		'comments' => array(
			//'required' => true,
			'min' => 0,
			'max' => 2000
		),
    ));

    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
		try{
        //Create a new user and inserting the info in user table.

			$sql = 'INSERT INTO locality(name, speciesId, locality, adult_size, hatchling_size, comments) VALUES(:name, :speciesId, :locality, :adult_size, :hatchling_size, :comments)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['name' => Input::get('name'), 'speciesId'=> Input::get('speciesId'), 'locality'=> Input::get('locality'), 'adult_size'=> Input::get('adult_size'), 'hatchling_size'=> Input::get('hatchling_size'), 'comments'=> Input::get('comments') ]);
			
 
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
											<label for="name">
												<input type="text" name="name" id="name" placeholder="Name" value="<?php echo escape(Input::get('name'));?>">
											</label>
											<select id="speciesId" name="speciesId">
												<option> Choose a species </option>
												<?php 
												$speci = DB::getInstance()->query("SELECT * FROM species");
												foreach($speci->results() as $speci){?> 
													<option value="<?php echo $speci->id; ?>"><?php echo $speci->common,  "&nbsp;&nbsp;&nbsp;" . $speci->latin; ?></option>
												<?php } ?>				
											</select>
											<label for="locality">
												<input type="text" name="locality" id="locality" value="<?php echo escape(Input::get('locality'));?>" placeholder="Locality/Area">
											</label>
											<label for="adult_size">
												<input type="text" name="adult_size" id="adult_size" value="<?php echo escape(Input::get('adult_size'));?>" placeholder="Adult size">
											</label>
											<label for="hatchling_size">
												<input type="text" name="hatchling_size" id="hatchling_size" placeholder="Hatchling size" value="<?php echo escape(Input::get('hatchling_size'));?>" placeholder="Hatchling size">
											</label>
											<label for="comments">
												<textarea name="comments" placeholder="Add your comments?" id="comments" value=<?php echo escape(Input::get('comments'));?> ></textarea>
											</label>
										</div>
										<input type="submit" value="Add locality" >
									</fieldset>	
								</form>
							</div>
						</div>
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>	

