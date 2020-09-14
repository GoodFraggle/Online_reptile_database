
<?php
  
  if (Session::exists('home')) {
    echo '<p>'.Session::flash('home').'</p>';
  }
  $user = new User();
  //https://www.youtube.com/watch?v=_Hm53TOM30c&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=17
  if($user->isLoggedIn()){
  ?>
    <p>Hello <a href="#"><?php echo escape($user->data()->name); ?> </a> !</p>
    <ul>
      <li><a href="user-index.php">User home page</a></li>
      <li><a href="logout.php">Log out</a></li>
      <li><a href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a></li>
      <li><a href="update.php">Update Profile</a></li>
      <li><a href="changepassword.php">Change Password</a></li>
      <!--<li><a href="AddSpecies.php">Add Species</a></li>
      <li><a href="working2AddAnimal.php">Add Animal 2</a></li>-->
    </ul>
  <?php 
  //https://www.youtube.com/watch?v=_Y-3YfVxIas&index=22&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc
  
  if($user->hasPermission('admin')){
        echo '<p>You have admin access</p>';
  }
  if($user->hasPermission('moderator')){
    echo '<p>You have Moderator access</p>';
}
  }else{
    echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
  }

?>