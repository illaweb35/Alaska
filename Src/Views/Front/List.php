<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

use app\Verif;

?>
<section class="section">
  <?php foreach ($billets as $bil) : ?>
    <div class="container">
      <div class="box">
        <article class="media">
          <?php
          if (!empty(Verif::filterName($bil->getImage()))) {
          ?>
            <figure class="media-left">
              <p class="image is-128x128">
                <img src="<?= BASEPATH . 'img/posts/' . Verif::filterName($bil->getImage()) ?>" alt="<?= Verif::filterName($bil->getTitle()) ?>">
              </p>
            </figure>
          <?php
          } ?>
          <div class="media-content">
            <div class="content">
              <p>
                <a href="<?= BASEPATH . 'Front/posting/' . Verif::filterInt($bil->getId()) ?>">
                  <strong><?= Verif::filterName($bil->getTitle()) ?></strong></a>
              </p>
              <br />
              <p>
                <?= substr($bil->getContent(), 0, 150) ?>...
              </p>
              <br />
              <small>Publié le :
                <em>
                  <?= date(' d - m - Y  à H : i', strtotime($bil->getCreate_at())); ?>
                </em>
              </small>
              <p>Par <strong><?= Verif::filterName($bil->getAuthor()) ?></strong>
              </p>
            </div>
          </div>
        </article>
      </div>
    </div>
  <?php endforeach ?>
</section>