$(document).ready(function() {
  $("moderate").click(function() {
    if ($(this).attr("contenteditable") == "true") {
      var contenu_avant = $(this).text();
      var id_bdd = $(this).attr("id");
      var champ_bdd = $(this).attr("moderate");
      $(this).blur(function() {
        var contenu_apres = $(this).text();
        if (contenu_avant != contenu_apres) {
          parametre = 'id=' + id_bdd + '&champ=' + champ_bdd + '&contenu=' + contenu_apres;
          //alert(param) ;
          $.ajax({
            url: "<?= BASEPATH.'Front/moderate' ?>",
            type: "POST",
            data: parametre,
            success: function(html) {
              //alert(html);
            }
          });
        }

      });

    };

  });
});
