<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace App;

/**
* Utilisation de la classe Viewer pour l'affichage des données
*/
use App\Viewer;

/**
* Classe Alert pour l'affichage de toutes les alertes du site
*/

class Alert
{/**
  *Function qui récupère le message d'erreur et génère la vue
  *@param  $errorMsg = contient le message à afficher
  * Instanciation de la classe Viewer pour générer la vue.
  */
    public static function getError($errorMsg)
    {
        $view = new Viewer("Error", 'Page d\'erreur');
        $view->createFile(['errorMsg' => $errorMsg]);
        require_once('../Src/Views/Error.phtml');
    }
}
