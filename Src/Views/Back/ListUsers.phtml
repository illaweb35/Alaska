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
    <h1 class="title is-3">Utilisateurs</h1>
    <div class="content">
      <p>
        Utilisateur Connecté:
        <strong><?= Verif::filterName($_SESSION['name'])?></strong>
      </p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="box">
          <div class="notification">
            <p class="title is-5">
              Liste des utilisateurs
            </p>
            <table class="table is-striped is-narrow is-hoverable">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>email</th>
                  <th>Date de création</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <?php foreach ($users as $user):?>
              <tbody>
                <tr>
                  <td><?= Verif::filterName($user->getUsername())?></td>
                  <td><?= Verif::filterEmail($user->getEmail())?></td>
                  <td><?= date(' d - M - Y à H:i', strtotime($user->getCreate_at()))?></td>
                  <td>
                    <a href="<?= BASEPATH.'Backedit/Update_user/'.Verif::filterInt($user->getId())?>">
                      <span class="icon">
                        <i class="fas fa-edit"></i>
                      </span>
                    </a>
                    <a href="<?= BASEPATH.'Backedit/Delete_user/'.Verif::filterInt($user->getId()) ?>">
                      <span class="icon">
                        <i class="fas fa-trash"></i>
                      </span>
                    </a>
                  </td>
                </tr>
              </tbody>
            <?php endforeach?>
            </table>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="box">
          <div class="notification">
            <p class="title is-4">
              Ajouter un utilisateur
              <form action="<?= BASEPATH.'Backedit/Create_user'?>" method="post">
                <div class="field">
                  <label for="username" class="label">Nom d'utilisateur</label>
                  <input type="text" class="input" name="username" value="<?php if (isset($_POST['username'])) {
    Verif::filterName($_POST['username']);
}?>" required/>
                </div>
                <div class="field">
                  <label for="email" class="label">Email</label>
                  <input type="text" class="input" name="email" pattern ="^[a-z0-9]+@([a-z0-9])+(\.)([a-z]{2,4})" value="<?php if (isset($_POST['email'])) {
    Verif::filterEmail($_POST['email']);
}?>" required/>
                </div>
                <div class="field">
                  <label for="password" class="label">Mot de Passe</label>
                  <input type="password" class="input" name="password"  required/>
                </div>
                <div class="field has-addons">
                  <div class="control">
                    <button class="button is-link" type="submit">Ajouté</button>
                    <button class="button is-text" type="reset">Annulé</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
