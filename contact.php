<?php
if (empty($_POST) === false) {
	$errors = array();
	
	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$message = $_POST['message'];
	$ip = $_POST['ip'];
	$httpref = $_POST['httpref'];
	$httpagent = $_POST['httpagent'];
	
	$name = str_replace(' ', '', $name);
	if(empty($name) === true || empty($email) === true || empty($message) === true) {
		$errors[] = 'Name, email and message are required!';
		}else{
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$errors[] = 'That\'s not a valid email address';
			}
			if(ctype_alpha($name) === false) {
				$errors[] = 'Name must only contain letters!';
			}
	}
	if (empty($errors) === true){
		mail('rich@harperz.biz', 'Contact form',$message ."\n \n" . $name . "\n" .  $ip . "\n".$httpref ."\n" .$httpagent, 'From: ' . $email);/*Change the email address that the email is to be sent to, here*/
		header('Location: contact.php?sent');/*Change the page to be sent after the email has been sent, here */
		exit();
	}
}
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>
<?php include'includes/head.php'; ?>
		<title>Contact</title>
		<?php include'includes/banner.php'; ?>
			<div class="box box-2">
				<article class="main">
					<div class="main-page main-page-1">
						<div class="page page-1">
							<h2>Contact</h2>
						</div>
						<div class="page-content">
						</div>
					</div>
					<div class="main-page main-page-2">
					<fieldset>
							<legend>Contact Form</legend>
						<?php
						if (isset($_GET['sent']) === true) {
							echo '<p>Thanks for contacting us!</p><br /><br /><br /><br /><br /><br /><br />';
						}else{	
							if (empty($errors) === false) {
								echo '<ul>';
								foreach($errors as $error) {
									echo '<li>', $error, '</li>';
								}
								echo '</ul>';
							}
							?>
							<form action="" method="post" id="contact_form" >
								<input type="hidden" name="ip" value="<?php echo $ipi ?>" />
								<input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
								<input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />
								<p>
									<label for="name">Name:</label><br>
									<input type="text" name="name" id="name" maxlength="140" <?php if(isset($_POST['name']) === true) { echo'value="', strip_tags($_POST['name']), '"';} ?>><div id="name_feedback"></div>
								</p>
								<p>
									<label for="email">Email:</label><br>
									<input type="text" name="email" id="email" maxlength="140" <?php if(isset($_POST['email']) === true) { echo'value="', strip_tags($_POST['email']), '"';} ?>><div id="email_feedback"></div>
								</p>
								<p>
									<label for="message">Message:</label><br>
									<textarea name="message" id="message" maxlength="1100" ><?php if(isset($_POST['message']) === true) { echo strip_tags($_POST['message']) ;} ?></textarea><div id="message_feedback"></div>
								</p>
								<p>
									<input type="submit" value="submit">
								</p>
							</form><br /><br />
							<?php
							}
							?>	
						</fieldset>
				<fieldset id="address">
				<legend>Address</legend>
				<br /> 132a High St,<br/> Gosport,<br /> Hampshire,<br /> PO121DU<br /><br />
				</fieldset>
							
	<script type="text/javascript" src="js/jfunc.js"></script>			
	</div>
				</article>
				<?php include'includes/left.php'; ?>
				<?php include'includes/right.php'; ?>
			<?php include'includes/footer.php'; ?>		