
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
								    echo'Hello <a href="#">';
								    echo escape($user->data()->name);
							        echo '</a>';
							        if($user->hasPermission('admin')){
					    					echo '<a href="admin-index.php">,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin Area</a>';	
							   				}
						       		echo '
							          <ul>
							            <li>
							            <a href="profile.php">'; $user= escape($user->data()->username); 
							             echo'Profile</a></li>
							            <li>';  
							   			echo '	
							   			</li>
							            <li><a href="update.php">Update Profile</a></li>
							            <li><a href="changepassword.php">Change Password</a></li>
							            <li><a href="logout.php">Log out</a></li>
							            <li><a href="AddSpecies.php">Add Species</a></li>
							            <li><a href="AddingAAnimal.php">Add Animal</a></li>
							            <li><a href="AddingMorph.php">Add Morph</a></li>
							            <li><a href="AddingDoubleMorph.php">Add Double Gene Morph</a></li>
							            <li><a href="AddingLocality.php">Add Locality</a></li>
							            <li><a href="AddingMixedLocality.php">Add Mixed Locality</a></li>
							          </ul>';
							        	
								}else{
									echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
								} 
							?>
						</div>	 
					</div>
				</div>
			</div>