<?php
  require_once 'core/init.php';
// if (file_exists($tempname)) {
//               $imagename = ucfirst($morph) . "_" . ucfirst($co) . "(" . ucfirst($la) . ")" . time() . "." . $fileExt;
//               $imageDestination = 'uploads/amimal_images/' . $imagename;
//               move_uploaded_file($tempname, $imageDestination);

replaces spaces and , repaces with _
  //$co = preg_replace('/[ ,]+/', '_', trim($co));

  // //strips all capitals
  // strtolower()
            
  // //capaptalise first letter
  // echo ucfirst()



  // loop count 

  // for($x = 1; $x <- 10; $x++):

  //   //loop what you want in here!!!

  // endfor;

  // https://www.youtube.com/watch?v=kEW6f7Pilc4&list=PLc53cnyC7lvCGHVkSMJzfNv19KGTyZTLT&index=10&t=1525s
  //database ("pdoposts") has one table "posts" with 6 fields "id(primory) AI", "title var 255", "body text", "auther var 255", "is_published boo default- as defind-true", "created_at datetime CURRENT_TIME "


  //$host =  'localhost';
  //$user = 'root';
  //$password = '123456';
  //$dbname = 'pdoposts';

  // Set DSN
  //$dsn = 'mysql:host='. $host .';dbname='. $dbname;

  // Create a PDO instance
  //$pdo = new PDO($dsn, $user, $password);
  //=== All above now comes from core/init.php and there is sets $pdo = new PDO-----
  
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  # PRDO QUERY



  $stmt = $pdo->query('SELECT * FROM posts');

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['title'] . '<br>';
  }

  while($row = $stmt->fetch()){
    echo $row->title . '<br>';
  }

  PREPARED STATEMENTS (prepare & execute)

  UNSAFE
  $sql = "SELECT * FROM posts WHERE author = '$author'";

  FETCH MULTIPLE POSTS

  // User Input
  $author = 'Brad';
  $is_published = true;
  $id = 1;
  $limit = 1;

  // Positional Params
  $sql = 'SELECT * FROM posts WHERE author = ? && is_published = ? LIMIT ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$author, $is_published, $limit]);
  $posts = $stmt->fetchAll();

  // Named Params
  // $sql = 'SELECT * FROM posts WHERE author = :author && is_published = :is_published';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute(['author' => $author, 'is_published' => $is_published]);
  // $posts = $stmt->fetchAll();

  // //var_dump($posts);
  foreach($posts as $post){
    echo $post->title . '<br>';
  }

  // FETCH SINGLE POST

  // $sql = 'SELECT * FROM posts WHERE id = :id';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute(['id' => $id]);
  // $post = $stmt->fetch();

  // echo $post->body;


  $sql = 'SELECT * FROM newAnimals WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $animal_id]);
    $post = $stmt->fetch();

    $speciesid = $post->speciesId;
    $morph = $post->morph;




  // GET ROW COUNT
  // $stmt = $pdo->prepare('SELECT * FROM POSTS WHERE author = ?');
  // $stmt->execute([$author]);
  // $postCount = $stmt->rowCount();

  // echo $postCount;

  INSERT DATA
  $title = 'Post Five';
  $body = 'This is post five';
  $author = 'Kevin';

  $sql = 'INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);
  echo 'Post Added';

  UPDATE DATA

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

  
  $id = 1;
  $body = 'This is the updated post';

  $sql = 'UPDATE posts SET body = :body WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['body' => $body, 'id' => $id]);
  echo 'Post Updated';

  // DELETE DATA
  // $id = 3;

  // $sql = 'DELETE FROM posts WHERE id = :id';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute(['id' => $id]);
  // echo 'Post Deleted';

  // SEARCH DATA
  // $search = "%f%";
  // $sql = 'SELECT * FROM posts WHERE title LIKE ?';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute([$search]);
  // $posts = $stmt->fetchAll();

  // foreach($posts as $post){
  //   echo $post->title . '<br>';
  // }