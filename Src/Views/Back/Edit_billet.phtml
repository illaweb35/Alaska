<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
use App\Verif;

?>
<section class="section">
  <div class="container">
      <h1 class="title">Modifier un Billet</h1>
      <div class="content">
        <p>Utilisateur Connecté:
          <strong>
            <?= Verif::filterName($_SESSION['name'])?>
          </strong>
        </p>
      </div>
      <div class="box">
        <form action="<?= BASEPATH.'Backedit/Update/'.Verif::filterInt($billets->getId())?>" method="post" enctype="multipart/form-data">
          <div class="field">
            <label for="Titre" name="title" class="label" > Titre du billet</label>
            <input type="text" name="title" class="input" value="<?= Verif::filterName($billets->getTitle())?>"/>
          </div>
          <div class="field">
            <div class="control">
              <textarea class="textarea" id="TinyModif" type="text" rows="6" name="content" ><?= $billets->getContent()?></textarea>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <div class="box">
                <p class="title is-5">Image à la une</p>
                <div class="columns">
                  <div class="column">
                    <div class="field">
                      <div class="file is-danger has-name is-boxed">
                        <label class="file-label">
                          <input class="file-input" type="file" name="image"/>
                          <span class="file-cta">
                            <span class="file-icon">
                              <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <span class="file-label">
                              Modifier l'image
                            </span>
                          </span>
                          <span class="file-name">
                          Nom du fichier : _
                          <?php if (!isset($_POST['image'])) {
    echo Verif::filterName($billets->getImage());
}?>
                          </span>
                        </label>
                        <div class="column">
                          <?php if (Verif::filterName($billets->getImage())):?>
                          <figure class="media-left">
                            <p class="image">
                              <img src="<?= BASEPATH.'img/posts/'.Verif::filterName($billets->getImage())?>" alt="<?= Verif::filterName($billets->getImage())?>">
                            </p>
                          </figure>
                          <div class="field">
                            <div class="control">
                              <a class="button" href="<?= BASEPATH.'Backedit/Delete_img/'.Verif::filterInt($billets->getId())?>">Effacer l'image</a>
                            </div>
                          </div>
                        <?php endif?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="column">
              <div class="box">
                <div class="field">
                  <label class="label">Auteur</label>
                  <input type="text" name="author" class="input" value="Jean Forteroche"/>
                </div>
                <div class="field">
                  <label class="checkbox switch">
                    <input type="checkbox" name="posted"
                     <?php
                     if (Verif::filterBool($billets->getPosted())== 1) {
                         ?>
                       checked="checked";
                     <?php
                     }?>
                     />
                    <span class="slider round"></span>
                  </label>
                    Poster
                </div>
              </div>
            </div>
          </div>
          <div class="column">
           <div class="field is-grouped">
            <div class="control">
             <button type="submit" class="button is-link" title="Mettre à jour le Billet">Mise à jour</button>
            </div>
            <div class="control">
             <button class="button" title="Annulé et revenir au billet original">
              <a href="javascript:history.go(-1)">Annuler</a>
             </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
