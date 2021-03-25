<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */


namespace app;

/**
 * Utilisation de la classe Viewer pour l'affichage des données
 */

use app\Viewer;

/**
 * Classe Alert pour l'affichage de toutes les alertes du site
 */
class Alert
{
  /**
   *Function qui récupère le message d'erreur et génère la vue
   *@param  $errorMsg = contient le message à afficher
   * Instanciation de la classe Viewer pour générer la vue.
   */
  public static function getError($errorMsg)
  {
    $view = new Viewer("Error", 'Page d\'erreur');
    $view->createFile(['errorMsg' => $errorMsg]);
    require_once '../Src/Views/Error.php';
  }
}
