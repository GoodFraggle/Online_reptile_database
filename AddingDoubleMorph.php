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
			'max' => 255,
		),
		'gene1' => array(
			'required' => true,
			
		),
		'gene2' => array(
			'required' => true,
			
		),
		'speciesId' => array(
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

			$sql = 'INSERT INTO double_gene(morph, gene1, gene2, speciesId, comments) VALUES(:morph, :gene1, :gene2, :speciesId, :comments)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['morph' => Input::get('morph'), 'gene1'=> Input::get('gene1'), 'gene2'=> Input::get('gene2'), 'speciesId'=> Input::get('speciesId'), 'comments'=> Input::get('comments') ]);
			
 
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
											<label for="morph">
												<input type="text" name="morph" id="morph" placeholder="Morph name" value="<?php echo escape(Input::get('morph'));?>">
											</label>
											<!-- <label for="gene">
												<select id="gene" id="gene" name="gene">
												  <option value="">Choose gene type</option>
												  <option value="recessive">Recessive</option>
												  <option value="codom">Codominance</option>
												  <option value="dominant">Dominant</option>
												</select>
											</label> -->

											<select id="gene1" name="gene1">
												<option value=""> Choose the first gene</option>
												<?php 
													$morphs = DB::getInstance()->query("SELECT * FROM morphs");
													foreach($morphs->results() as $morphs){?> 
														<option value="<?php echo $morphs->id; ?>"><?php echo $morphs->morph;?></option>
												<?php } ?>				
											</select>

											<select id="gene2" name="gene2">
												<option value="">Choose the first gene</option>
												<?php 
													$morphs = DB::getInstance()->query("SELECT * FROM morphs");
													foreach($morphs->results() as $morphs){?> 
														<option value="<?php echo $morphs->id; ?>"><?php echo $morphs->morph;?></option>
												<?php } ?>			
											</select>
											
											<select id="speciesId" name="speciesId">
												<option value=""> Choose a species </option>
												<?php 
													$speci = DB::getInstance()->query("SELECT * FROM species");
													foreach($speci->results() as $speci){?> 
														<option value="<?php echo $speci->id; ?>"><?php echo $speci->common,  "&nbsp;&nbsp;&nbsp;" . $speci->latin; ?></option>
												<?php } ?>				
											</select>

											<label for="comments">
												<textarea name="comments" placeholder="Add your comments?" id="comments" value=<?php echo escape(Input::get('comments'));?> ></textarea>
											</label>
										</div>
										<input type="submit" value="Add double gene morph" >
									</fieldset>	
								</form>
							</div>
						</div>
					</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>		