var app = {


  hardMode: false,

 
  clickEnable: true,

  
  cardMatch: 0,

 
  card1: null,
  card2: null,

  
  init: function() {


    $('#normal, #hard').on('click', app.startGame);
  },

  
  startGame: function(evt) {

   
    $('.menu').hide();

  
    if ($(evt.target).attr('id') == "hard") app.hardMode = true;

    app.generateCards();

   
    $('.progressBar').animate(
      { width: "100%" },
      (app.hardMode) ? 90 * 1000 : 60 * 1000,
      function() {

      
        window.alert("Vous avez perduuuuuuuuuu !");
        window.location.reload();
      });
  },

 
  generateCards: function() {

    
    var max = 13;
    
    if (app.hardMode) max = 17;

   
    var zeroToMax1 = app.generateArray( max );


  
    var zeroToMax2 = app.generateArray( max );

    var allCardsNumber = zeroToMax1.concat(zeroToMax2);


    for (var i = 0; i < allCardsNumber.length; i++) {

 
      var carte = $('<div class="carte">');
      var cache = $('<div class="cache">');
      var image = $('<div class="image">');

  
      image.css('background-position', '0 -' + allCardsNumber[ i ] + '00px');
    

     
      carte.append(cache);
      carte.append(image);

  
      carte.on('click', app.cardClick);

  
      $('#container').append(carte);
    }

 
    if (app.hardMode) $('#container').css('width', '990px');
  },

  
  generateArray: function(max) {

    var tab = [];

    for (var nb = 0; nb <= max; nb++) {

   
      tab.push(nb);
    }

    return tab;
  },

 
  cardClick: function(evt) {


    if (app.clickEnable) {

     
      if ($(evt.target).hasClass('image')) return;

      
      var carte = $(evt.target).parent();
      
      var image = carte.children(".image");

    
      carte.addClass('flipped');
      
      carte.children(".cache").hide();
      
      carte.children(".image").show();


     
      if (app.card1 == null) {

       
        app.card1 = image;

      }
      else {

    
        app.card2 = image;

        
        app.clickEnable = false;

        
        if (app.card2.css('background-position') != app.card1.css('background-position')) {

          // Les deux cartes ne sont pas les mêmes, je vais
          // les masquer dans 1 seconde
          setTimeout(function() {
            // Je retourne la première carte face cachée
            app.card1.hide();
            app.card1.prev().show();
            app.card1.parent().removeClass('flipped');

            // Je retourne la deuxième carte face cachée
            app.card2.hide();
            app.card2.prev().show();
            app.card2.parent().removeClass('flipped');

            // J'indique seulement à ce moment qu'on peut
            // de nouveau cliquer sur les images
            app.clickEnable = true;

            // Je pense bien à supprimer ce que j'ai dans
            // mes variables, sinon ça va tout casser :p
            app.card1 = null;
            app.card2 = null;
          },
          // On fait bien tout ça dans 1 seconde
          1000);

        } else {

          // Les deux cartes sont les mêmes !
          // J'indique qu'on peut tout de suite retourner
          // une nouvelle carte
          app.clickEnable = true;

          // Je pense bien à supprimer ce que j'ai dans
          // mes variables, sinon ça va tout casser :p
          app.card1 = null;
          app.card2 = null;

          // J'indique qu'on a trouvé une paire de plus !
          app.cardMatch += 1;

          // La dernière chose qu'il me reste à faire,
          // c'est de regarder si on a gagné ou pas !
          app.isWin();

          // Si on test, on voit que ça n'affiche pas
          // la dernière carte, on peut laisser un petit
          // moment au navigateur pour qu'il fasse la
          // transition.
          // setTimeout(app.isWin, 1000);
        }
      }
    }
  },

  isWin: function() {

    if (!app.hardMode && app.cardMatch == 14) {

      // Mode "normal" + 14 paires de trouvées !
      window.alert("Vous avez gagnéééééééééé !");
      window.location.reload();
    }
    else if (app.hardMode && app.cardMatch == 18) {

      // Mode "hard" + 18 paires de trouvées !
      window.alert("Vous avez gagnéééééééééé !");
      window.location.reload();
    }
  },

  // On a récupérer une fonction de mélange, parce qu'on
  // ne veux pas ré-inventer la roue et que c'est pas facile !
  // Là ce que ça fait, c'est des permutations entre les
  // différentes valeurs du tableau
  // https://stackoverflow.com/questions/6274339/how-can-i-shuffle-an-array
  shuffle: function(list) {

    for (let i = list.length - 1; i > 0; i--) {

      const j = Math.floor(Math.random() * (i + 1));
      [list[i], list[j]] = [list[j], list[i]];
    }

    return list;
  }
}

// On démarre notre application
$(app.init);
