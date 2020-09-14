	// check if logged  in,
	if logged in then show member options in banner menu,
	If user is admin show link to admin index 
	</head>
	<body>
		<div class="container">
			<div class="box box-1">
				<header class="header"></header>
				<div class="top-side top-side-1">
					<h1>Bad</br>&emsp; Fraggle's</br>&emsp;&emsp; Reptiles</h1>
				</div>
				<div class="top-side top-side-2">
					<div class="login">
						<?php
							if (Session::exists('home')) {
							    echo '<p>'.Session::flash('home').'</p>';
							  }
							$user = new User();
							//https://www.youtube.com/watch?v=_Hm53TOM30c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=17
							if($user->isLoggedIn()){
							if($user->hasPermission('admin')){

					<div class="admin-menu">
						<ul>       
						    <li><a href="admin-index.php">admin</a></li>
						</ul>
					</div>
					<div class="top-1">
						<p>Hello <a href="#"> <?php echo escape($user->data()->name); ?></a></p>
					</div> 
					<div class="top-2">
						<div class="user-menu">
						    <ul>
						        <li><a href="profile.php"><?php $user= escape($user->data()->username); ?>Profile</a></li>
						        <li><a href="update.php">Update Profile</a></li>
						        <li><a href="changepassword.php">Change Password</a></li>
						        <li><a href="logout.php">Log out</a></li>
						        <!--<li><a href="AddSpecies.php">Add Species</a></li>
						        <li><a href="working2AddAnimal.php">Add Animal 2</a></li>-->
						    </ul>
						</div>
					</div>
					<?php
					    //https://www.youtube.com/watch?v=_Y-3YfVxIas&index=22&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
					    if($user->hasPermission('admin')){
					        echo '<p>You have admin access</p>';
					    }
					    if($user->hasPermission('moderator')){
					        echo '<p>You have Moderator access</p>';
					    }
					   }  
					  }else{
					    echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
					  }  
					</div>
				</div>
			</div>