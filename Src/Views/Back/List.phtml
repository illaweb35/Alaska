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
  <div class="content">
    <p>
      Utilisateur Connecté:
      <strong><?= Verif::filterName($_SESSION['name'])?></strong>
    </p>
  </div>
  <?php foreach ($billets as $bil):?>
  <div class="container">
    <div class="box">
      <article class="media">
        <?php if (!empty(Verif::filterName($bil->getImage()))) {
    ?>
        <figure class="media-left">
          <p class="image is-128x128">
            <img src="<?= BASEPATH.'img/posts/'.Verif::filterName($bil->getImage())?>" alt="<?= Verif::filterName($bil->getTitle())?>">
          </p>
        </figure>
      <?php
}?>
        <div class="media-content">
          <div class="content">
            <p>
              <a href="<?= BASEPATH .'Front/posting/'. Verif::filterInt($bil->getId())?>">
              <strong><?= Verif::filterName($bil->getTitle()) ?></strong>
              </a>
            </p>
            <br/>
            <p>
            <?=  substr($bil->getContent(), 0, 150); ?>...
            </p>
            <br/>
              <small>Publié le :
                <em>
                <?= date('d - m - Y à H : i', strtotime($bil->getCreate_at())); ?>
              </em>
            </small>
            <p>
              Par
              <strong><?= Verif::filterName($bil->getAuthor()) ?></strong>
            </p>
            <div class="field">
              <label class="checkbox switch">
                <input type="checkbox" name="posted" value="<?= Verif::filterBool($bil->getPosted())?>" <?php if (Verif::filterBool($bil->getPosted())== 1) {
        ?>checked="checked"<?php
    }?>/>
                <span class="slider round"></span>
              </label>
                Poster
            </div>
          </div>
          <nav class="level is-mobile">
            <div class="level-left">
              <a class="level-item" aria-label="mmodif" title="Modifier le billet" href="<?= BASEPATH.'Backedit/Update/'.Verif::filterInt($bil->getId())?>">
                <span class="icon is-small">
                  <i class="fas fa-edit" aria-hidden="true"></i>
                </span>
              </a>
              <a class="level-item" aria-label="delete" title="Supprimer le billet" href="<?= BASEPATH.'Backedit/Delete/'.Verif::filterInt($bil->getId())?>">
                <span class="icon is-small">
                  <i class="fas fa-trash" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </nav>
        </div>
      </article>
    </div>
  </div>
<?php endforeach?>
</section>
