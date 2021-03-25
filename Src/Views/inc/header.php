<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

namespace Src\Views;

use app\Check;

if ($_SESSION['authenticated']) {
  Check::verifSession();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <link rel="stylesheet" href="<?= BASEPATH . 'css/master.css' ?>" />
  <title><?= $title ?></title>
</head>

<body>
  <header id="haut">
    <?php
    if (isset($_SESSION['authenticated'])) {
      include_once 'navbar_admin.php';
    } else {
      include_once 'navbar.php';
    } ?>
  </header>