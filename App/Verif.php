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
* Classe de filtration pour les entrées et sortie du site
* Evite les failles XSS  et fait une vérification du format demandé
*/
class Verif
{
    /**
    * Filtration des type String et mise en place d'un regex de formattage.
    * fonction trim pour les espaces
    * fonction hmltspeciachars pour les caractères spéciaux
    */
    public static function filterName($field)
    {
        $field = \filter_var(\trim($field), FILTER_SANITIZE_STRING);
        if (!empty($field)) {
            //if (\filter_var($field, FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^([a-zA-ZÀ-ÖØ-öø-ÿœŒ]+[- ']?[a-zA-ZÀ-ÖØ-öø-ÿœŒ]+)+$/u"]])) {
            return htmlspecialchars($field);
            //  }
        }
    }
    /**
    *vérification pour les adresses email
    * fonction trim pour les espaces
    * fonction htmlspecialchars pour les caractères spéciaux.
    */
    public static function filterEmail($field)
    {
        $field = \filter_var(\trim($field), FILTER_SANITIZE_EMAIL);
        if (\filter_var($field, FILTER_VALIDATE_EMAIL)!== false) {
            return \htmlspecialchars($field);
        }
    }
    /**
    * Verification des contenu texte utilisant le formattage TinyMCe
    */
    public static function filterString($field)
    {
        $field = \filter_var(\trim($field), FILTER_SANITIZE_STRING);
        if (!empty($field)) {
            return $field;
        }
    }
    /**
    * Verification des Booléens
    */
    public static function filterBool($field)
    {
        $field = \filter_var(\trim($field), FILTER_VALIDATE_BOOLEAN);
        if (!empty($field)) {
            return \htmlspecialchars($field);
        }
    }
    /**
    * Vérification des entiers.
    */
    public static function filterInt($field)
    {
        $field = \filter_var(\trim($field), FILTER_VALIDATE_INT);
        if (!empty($field)) {
            return \htmlspecialchars($field);
        }
    }
}
