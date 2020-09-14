<?php  require_once 'core/init.php';
$user = new User();
if(!$user->hasPermission('admin')){
	Redirect::to('index.php');
}
$litterId = $_GET['link'];//litterId
if (empty($litterId)){$litterId =  }
$hatchlingIdNo = $_GET['hatch'];//litterId

$sql = 'SELECT * FROM littermates WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $litterId]);
$post = $stmt->fetch();

$con = 'SELECT * FROM animals WHERE id = :id';
$stm = $pdo->prepare($con);
$stm->execute(['id' => $post->mum]);
$mumname = $stm->fetch();

$st = $pdo->prepare($con);
$st->execute(['id' => $post->dad]);
$dadname = $st->fetch();

$get = 'SELECT * FROM littermates WHERE id = :id';
$lit = $pdo->prepare($get);
$lit->execute(['id' => $litterId]);
$litt = $lit->fetch();

if(Input::exists()){
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
    	'name' => array(
		'min' => 0,
		'max' => 255,
		),		
    ));
    $dohDay = Input::get('dohDay');
    $dohMonth = Input::get('dohMonth');
    $dohYear = Input::get('dohYear');
    $doh = $dohDay . '-' . $dohMonth . '-' . $dohYear;

    /*Validation checks for the different fields on the page*/
    //https://www.youtube.com/watch?v=G3hkHIoDi6M&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=14
    if($validation->passed()){
    	try{
    		$fields = "UPDATE littermates SET comments = :comments, name = :name, speciesId = :speciesId, vivNo = :vivNo, doh = :doh, morph = :morph, doubleMorph = :doubleMorph, locality = :locality, mixedLocality = :mixedLocality, price = :price, status = :status, sex = :sex, breeder = :breeder WHERE id = :id";

			$field = $pdo->prepare($fields);

			$field->bindParam(':comments', Input::get('comments'), PDO::PARAM_STR);
			$field->bindParam(':name', Input::get('name'), PDO::PARAM_STR);
			$field->bindParam(':speciesId', Input::get('speciesId'), PDO::PARAM_STR);
			$field->bindParam(':vivNo', Input::get('vivNo'), PDO::PARAM_STR);
			$field->bindParam(':doh', $doh, PDO::PARAM_STR);
			$field->bindParam(':morph', Input::get('morph'), PDO::PARAM_STR);
			$field->bindParam(':doubleMorph', Input::get('doubleMorph'), PDO::PARAM_STR);
			$field->bindParam(':locality', Input::get('locality'), PDO::PARAM_STR);
			$field->bindParam(':mixedLocality', Input::get('mixedLocality'), PDO::PARAM_STR);
			$field->bindParam(':price', Input::get('price'), PDO::PARAM_STR);
			$field->bindParam(':status', Input::get('status'), PDO::PARAM_STR);
			$field->bindParam(':sex', Input::get('sex'), PDO::PARAM_STR);
			$field->bindParam(':breeder', Input::get('breeder'), PDO::PARAM_STR);
			$field->bindParam(':id', $litterId, PDO::PARAM_STR);
			$field->execute();

        //Success message when account is created
        Redirect::to(BASE_URL . 'hatchlingList.php?link=' . $litt->litterId );        
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
		<title>View Hatchlings litter mates</title>
			<?php include'includes/banner.php'; ?>
				<div class="box box-2">
					<article class="main">						
						<div class="page-content">
							<div class="main-page main-page-2">
								<h3>Hatchling/baby no:<?php echo $litterId; ?></h3>				 
									<form action="" method="POST" autocomplete="off">
									<div class="formdiv">
										<div class="formdivs">
											Mother:<span><?php echo escape(ucfirst($mumname->name));?></span>
										</div>
										<div class="formdivs">
											Father: <span><?php echo escape(ucfirst($dadname->name)); ?></span>
										</div>
										<div class="formdivs">
											DOB or Date of laying:<span> 
											<?php 
												$dateStr = $post->dob;
												echo date("NS F Y", strtotime($dateStr));
											;?></span> 
										</div>
										<div class="formdivs">
											Date Clutch/Litter registered:<span>
											<?php 
												$dateStr = $post->date;
												echo date("NS F Y", strtotime($dateStr)); 
											?></span>
										</div>
									</div>	
							<fieldset>
								<label for="name">
									Name: 
									<input type="text" name="name" id="name" value="<?php echo escape(ucfirst($litt->name));?>">
								</label>
								<label for="speciesId">
									Species:
									<select id="speciesId" name="speciesId">
										<option> Choose a species </option>
										<?php 
											$speci = DB::getInstance()->query("SELECT * FROM species");
											foreach($speci->results() as $speci){?> 
												<option value="<?php echo $speci->id; ?>"><?php echo $speci->common,  "&nbsp;&nbsp;&nbsp;" . $speci->latin; ?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="vivNo">
									Viv No: 
									<input type="text" name="vivNo" id="vivNo" value="<?php echo escape(ucfirst($litt->vivNo));?> ">
								</label>
								<label for="doh">
									Date of birth
									<select id="dohDay" name="dohDay">
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
										echo '<select id="dohMonth" name="dohMonth">';
											for($i = 1; $i <= 12; $i++){
												$dt = DateTime::createFromFormat('!m', $i);
												echo "<option value=".$dt->format('m').">".$dt->format('F m')."</option>";
											}
										echo '</select>';
										//year
										echo '<select id="dohYear" name="dohYear">';
											for($i = date('Y'); $i >= date('Y', strtotime('-3 years')); $i--){
											  echo "<option value=\"$i\">$i</option>";
											} 
										echo '</select>';
									?>
								</label>
								<label for="morph">
									Morph: 
									<select id="morph" name="morph">
										<option value="0"> Morph </option>
										<?php 
											$morph = DB::getInstance()->query("SELECT * FROM morphs");
											foreach($morph->results() as $morph){?> 
												<option value="<?php echo $morph->id; ?>"><?php echo $morph->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="doubleMorph">
									Double Gene Morph: 
									<select id="doubleMorph" name="doubleMorph">
										<option value="0"> Morph with 2 gene's </option>
										<?php 
											$doubleMorph = DB::getInstance()->query("SELECT * FROM double_gene");
											foreach($doubleMorph->results() as $doubleMorph){?> 
												<option value="<?php echo $doubleMorph->id; ?>"><?php echo $doubleMorph->morph;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="locality">
									locality: 
									<select id="locality" name="locality">
										<option value="0"> Locality </option>
										<?php 
											$locality = DB::getInstance()->query("SELECT * FROM locality");
											foreach($locality->results() as $locality){?> 
												<option value="<?php echo $locality->id; ?>"><?php echo $locality->name;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="mixedLocality">
									Mixed Locality: 
									<select id="mixedLocality" name="mixedLocality">
										<option value="0"> Mixed Locality </option>
										<?php 
											$mixedLocality = DB::getInstance()->query("SELECT * FROM mixed_locality");
											foreach($mixedLocality->results() as $mixedLocality){?> 
												<option value="<?php echo $mixedLocality->id; ?>"><?php echo $mixedLocality->name;?></option>
										<?php } ?>				
									</select>
								</label>
								<label for="price">
									Price: 
									<input type="text" name="price" id="price" value="<?php echo escape(ucfirst($litt->price));?>">
								</label>
								<label for="status">
									Status:
									<select id="status" name="status">
										<option value="">Choose the status</option>
										<option value="Hold">Hold back</option>	
										<option value="breed">Breeding</option>
										<option value="breed">Not ready</option>	
										<option value="sale">Forsale</option>				
									</select>
								</label>
								<label for="sex">
									Sex:
									<select id="sex" name="sex">
										<option value="">Choose the sex</option>
										<option value="male">Male</option>	
										<option value="female">Female</option>		
										<option value="not sexed">Not sexed</option>			
									</select>
								</label>
									
								<label for="comments">
									Comments:
									<textarea name="comments" id="comments" ><?php echo escape(ucfirst($litt->comments));?></textarea>
								</label>
								<label for="breeder">
									<input type="hidden" name="breeder" id="breeder" value="<?php echo $user; ?>">
								</label>
								<input type="submit" value="Add">
							</fieldset>
						</form>
								</p>	
							</div>
						</div>
					</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
				<?php include'includes/footer.php'; ?>