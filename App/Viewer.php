<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace App;

use App\Alert;

/**
* Classe Viewer pour l'affichage des données
*@param variable $_file qui contient le fichier crée par la fonction creatFile suivant les données recueillies.
*@param variable $_title qui récupère le tire pour chaque page
*/
class Viewer
{
    private $_file;
    private $_title;
    /**
    *Fonction de construction de la vue
    *@param variable $action suivant la méthode défini dans l'url
    *@param variable $title recupère le tire de la page
    */
    public function __construct($action, $title)
    {
        $this->_file = '../Src/Views/'.$action.'.phtml';
        $this->_title = $title;
    }
    /**
    *Affichage de la vue
    */
    public function View($data)
    {
        $view = $this->createFile($data);
        echo $view;
    }
    /**
    *Fonction de création du fichier des données
    *@param variable $data les données récupérées
    * extraction des données puis ouverture du template pour affichage
    */
    public function createFile($data)
    {
        if (\file_exists($this->_file)) {
            \ob_start();
            \extract($data, EXTR_OVERWRITE);
            require_once $this->_file;
            $content = \ob_get_clean();
            $title = $this->_title;
            require_once('../Src/Views/Template.phtml');
        } else {
            throw new \Exception(Alert::getError($errorMsg ="Fichier View :' .$this->_file. 'introuvable", 1));
        }
    }
}
