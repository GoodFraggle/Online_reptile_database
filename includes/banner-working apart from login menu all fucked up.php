
</head>
	<body>
		<div class="container">
			<div class="box box-1">
				
				<div class="top-side top-side-1">
					<header class="header"><a href="index.php"><h1>Bad</br>&emsp; Fraggle's</br>&emsp;&emsp; Reptiles</h1></a></header>
				</div>
				<div class="top-side top-side-2">
					<div class="login">
    					<div class="user-menu">
						<?php	
							if (Session::exists('home')) { echo '<p>'.Session::flash('home').'</p>';}
  							$user = new User();

		 					//https://www.youtube.com/watch?v=_Hm53TOM30c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=17
			  				if($user->isLoggedIn()){
			    				if($user->hasPermission('admin')){
			    					echo '<span class="admin-menu"><a href="admin-index.php">Admin Area</a></span> <br>';	
					   			}
									//https://www.youtube.com/watch?v=_Y-3YfVxIas&index=22&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
        							if($user->hasPermission('admin')){
              							echo 'You have Admin access.  ';
        							}
        							if($user->hasPermission('moderator')){
          								echo 'You have Moderator access <br> ';
       								 }
						    echo'Hello <a href="#">';
						     echo escape($user->data()->name);
					       echo '</a>';
					       		?>
						          <ul>
						            <li>
						            <a href="profile.php"><?php $user= escape($user->data()->username); 
						             echo'Profile'?></a></li>

						       
						            <li><a href="update.php">Update Profile</a></li>
						            <li><a href="changepassword.php">Change Password</a></li>
						            <li><a href="logout.php">Log out</a></li>
						            <li><a href="AddSpecies.php">Add Species</a></li>
						            <li><a href="AddingAAnimal.php">Add Animal</a></li>
						            <li><a href="AddClutch.php">Add Clutch</a></li>
						          </ul>
						        	<?php
							}else{
								echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
							} 
							?>   
							
						</div>	 
					</div>
				</div>
			</div>