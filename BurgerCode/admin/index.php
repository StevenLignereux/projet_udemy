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
      <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><i class="fas fa-plus"></i>
          Ajouter</a></h1>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require 'database.php';
            $db = Database::connect();
            $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                                     FROM items LEFT JOIN categories ON items.category = categories.id
                                     ORDER BY items.id DESC');
            while($item = $statement->fetch()) 
            {
              echo '<tr>';
                echo '<td>'. $item['name'] .'</td>';
                echo '<td>'. $item['description'] .'</td>';
                echo '<td>'. number_format((float)$item['price'],2,'.','') .'</td>';
                echo '<td>'. $item['category'] .'</td>';
                echo '<td width="350px">';
                echo '<a class="btn btn-default" href="view.php?id='. $item['id'] .'"><span><i class="far fa-eye"></i></span> Voir</a>';
                echo ' ';
                echo '<a class="btn btn-primary" href="update.php?id='. $item['id'] .'"><span><i class="fas fa-edit"></i></span> Modifier</a>';
                echo ' ';
                echo '<a class="btn btn-danger " href="delete.php?id='. $item['id'] .'"><span><i class="fas fa-times"></i></span> Supprimer</a>';
                echo ' ';
                echo '</td>';
                echo '</td>';
              echo '</tr>';
            }
            Database::disconnect();
          ?>

        </tbody>
      </table>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>