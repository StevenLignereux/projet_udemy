<?php 
  require 'database.php';

  if(!empty($_GET['id']))
  {
    $id = checkInput($_GET['id']);
  }

  $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

  if(!empty($_POST))
  {
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['category']);
    $image = checkInput($_FILES['image']['name']);
    $imagePath = '../images/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;


    if(empty($name))
    {
      $nameError = 'Ce champ ne peut être vide';
      $isSuccess = false;
    }
    if(empty($description))
    {
      $descriptionError = 'Ce champ ne peut être vide';
      $isSuccess = false;
    }
    if(empty($price))
    {
      $priceError = 'Ce champ ne peut être vide';
      $isSuccess = false;
    }
    if(empty($category))
    {
      $categoryError = 'Ce champ ne peut être vide';
      $isSuccess = false;
    }
    if(empty($image))
    {
      $isImageUpdated = false;
    }
    else
    {
      $isImageUpdated = true;
      $isUploadSucess = true;
      if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
      {
        $imageError = "Les fichiers autorisés sont: .jpg .png .jped .gif";
        $isUploadSucess = false;
      }
      if(file_exists($imagePath))
      {
        $imageError = "Le fichier existe déja !";
        $isUploadSucess = false;
      }
      if($_FILES['image']['size'] > 500000)
      {
        $imageError = "Le fichier ne doit pas dépasser les 500KB";
        $isUploadSucess = false;
      }
      if($isUploadSucess)
      {
        if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
        {
          $imageError = "Il y'a eu une erreur lors de l'upload";
          $isUploadSucess = false;
        }
      }
    }

    if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
    {
      $db = Database::connect();
      if($isImageUpdated)
      {
        $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, image = ? WHERE id = ?");
        $statement->execute(array($name,$description,$price,$category,$image, $id));
      }
      else
      {
        $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ? WHERE id = ?");
        $statement->execute(array($name,$description,$price,$category, $id));
      }
      Database::disconnect();
      header("Location: index.php");
    }
    else if(false)
    {
      $db = Database::connect();
      $statement = $db->prepare("SELECT * FROM items WHERE id = ?");
      $statement->execute(array($id));
      // On s'arrete ici
      Database::disconnect();
    }
  }
  else
  {

  }

  function checkInput($data)
  {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Burger Code</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h1 class="text-logo"><i class="fas fa-utensils"></i> Burger Code <i class="fas fa-utensils"></i></h1>
  <div class="container admin">
    <div class="row">
      <div class="col-sm-6">
        <h1><strong>Modifier un item </strong></h1>
        <br>
        <form class="form" role="form" action="<?php echo 'update.php?id='. $id;?> " method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;  ?>">
            <span class="help-inline">
              <?php echo $nameError;  ?></span>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;  ?>">
            <span class="help-inline">
              <?php echo $descriptionError;  ?></span>
          </div>
          <div class="form-group">
            <label for="price">Prix: (en €)</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price;  ?>">
            <span class="help-inline">
              <?php echo $priceError;  ?></span>
          </div>
          <div class="form-group">
            <label for="category">Catégorie:</label>
            <select class="form-control" name="category" id="category">
              <?php
            $db = Database::connect();
            foreach($db->query('SELECT * FROM categories') as $row)
            {
              if($row['id'] == $category)
                echo '<option selected="selected" value="' .$row['id']. '">' .$row['name']. '</option>';
              else
                echo '<option value="' .$row['id']. '">' .$row['name']. '</option>';
            }
            Database::disconnect();
          ?>
            </select>
            <span class="help-inline">
              <?php echo $categoryError;  ?></span>
          </div>
          <div class="form-group">
            <label>Image:</label>
            <p><?php echo$image; ?></p>
            <label for="image">Séléctionner une image:</label>
            <input type="file" id="image" name="image">
            <span class="help-inline">
              <?php echo $imageError; ?></span>
          </div>

          <br>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Modifier</button>
            <a href="index.php" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i> Retour</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>