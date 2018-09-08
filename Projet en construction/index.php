<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contactez-moi</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <div class="container">
    <div class="divider"></div>
    <div class="heading">
      <h2>Contactez-moi !</h2>
    </div>
    <div class="row">
      <div class="col-lg-12 col-lg-offset-1">
        <form method="POST" action="" role="form" id="contact-form">
          <div class="row">
            <div class="col-md-6">
              <label for="firstname">Prénom <span class="blue"> *</span></label>
              <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value="">
              <p class="comments"></p></p>
            </div>

            <div class="col-md-6">
              <label for="name">Nom<span class="blue"> *</span></label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="">
              <p class="comments"></p>
            </div>

            <div class="col-md-6">
              <label for="email">Email<span class="blue"> *</span></label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" value="">
              <p class="comments"></p>
            </div>

            <div class="col-md-6">
              <label for="phone">Téléphone</label>
              <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre numéro" value="">
              <p class="comments"></p>
            </div>

            <div class="col-md-12">
              <label for="message">Message<span class="blue"> *</span></label>
              <textarea name="message" class="form-control" id="message" placeholder="Votre message" rows="4"></textarea>
              <p class="comments"></p>
            </div>

            <div class="col-md-12">
              <p class="blue"><strong> * Ces informations sont requises</strong></p>
            </div>

            <div class="col-md-12">
              <input type="submit" class="button1" value="Envoyer">
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>

</body>

</html>