<?php
  require 'database.php';

  if(!empty($_GET['id']))
  {
    $id = checkInput($_GET['id']);
  }

  $db = Database::connect();
  $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                                     FROM items LEFT JOIN categories ON items.category = categories.id
                                     WHERE items.id = ?');
  $statement->execute(array($id));
  $item = $statement->fetch();
  Database::disconnect();

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
        <h1><strong>Voir un item </strong></h1>
        <br>
        <form>
          <div class="form-group">
            <label>Nom:</label>
            <?php echo '  ' . $item['name']; ?>
          </div>
          <div class="form-group">
            <label>Description:</label>
            <?php echo '  ' . $item['description']; ?>
          </div>
          <div class="form-group">
            <label>Prix:</label>
            <?php echo '  ' . number_format((float)$item['price'],2,'.',''). ' €'; ?>
          </div>
          <div class="form-group">
            <label>Catégorie:</label>
            <?php echo '  ' . $item['category']; ?>
          </div>
          <div class="form-group">
            <label>Image:</label>
            <?php echo '  ' . $item['image']; ?>
          </div>
        </form>
        <br>
        <div class="form-actions">
          <a href="index.php" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i> Retour</a>
        </div>
      </div>
      <div class="col-sm-6 site">
        <div class="card">
          <img src="<?php echo '../images/'.$item['image'] ;?>" alt="image" class="card-img-top">
          <div class="price"> <?php echo number_format((float)$item['price'],2,'.',''). ' €'; ?></div>
          <div class="caption">
            <h4><?php echo $item['name']; ?></h4>
            <p><?php echo $item['description']; ?></p>
            <a href="#" class="btn btn-order" role="button"><i class="fas fa-shopping-cart"></i>Commander</a>
          </div>
        </div>
      </div>

    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>