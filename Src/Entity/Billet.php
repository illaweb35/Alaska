<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

namespace Src\Entity;

require_once '../app/pattern/Hydrator.trait.php';

use app\pattern\Hydrator;
use app\Alert;

class Billet
{
    private $id_bil;
    private $title;
    private $author;
    private $content;
    private $image;
    private $create_at;
    private $modif_at;
    private $posted;

    /**
     * Initialisation des données vers l'hydratation
     * @param  $data = est un tableau des données
     */
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Utilisation du trait hydrator pour l'hydratation des données
     */
    use Hydrator;

    /**
     * Mise en place des Setters avec vérification de format
     */
    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author)) {
            Alert::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->author = $author;
        }
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            Alert::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->title = $title;
        }
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            Alert::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->content = $content;
        }
    }

    public function setImage($image)
    {
        if (is_string($image)) {
            $this->image = $image;
        }
    }

    public function setCreate_at(\DateTime $create_at)
    {
        $this->create_at = $create_at;
    }
    public function setModif_at(\DateTime $modif_at)
    {
        $this->modif_at = $modif_at;
    }

    public function setPosted($posted)
    {
        if (is_bool($posted)) {
            $this->posted = (int)$posted;
        }
    }
    /**
     * Mise en place des GETTERS
     */
    public function getId()
    {
        return $this->id_bil;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCreate_at()
    {
        return $this->create_at;
    }
    public function getModif_at()
    {
        return $this->Modif_at;
    }
    public function getPosted()
    {
        return $this->posted;
    }
}
