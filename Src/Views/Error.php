<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */
?>
<section class="section">
  <div class="container ">
    <div class="box">
      <div class="card">
        <div class="card-image">
          <figure class="image is-square">
            <img src="<?= BASEPATH . 'img/404.jpg' ?>" alt="Erreur 404">
          </figure>
        </div>
        <div class="card-content">
          <h1 class="title">Oups! </h1>
          <div class="notification is-danger">
            <strong>
              <p><?= $errorMsg ?>></p>
            </strong>
          </div>
          <footer class="card-footer">
            <a href="javascript:history.go(-1)" class="button is-link"><span>Retour </span>
              <span class="icon">
                <i class="fas fa-undo"></i>
              </span>
            </a>
          </footer>
        </div>
      </div>
    </div>
  </div>
</section>