<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Commente",
 *     uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idCom", columns={"user_id", "article_id"})
 * })
 * */
class Commente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="text")
     */
    protected $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Commentes")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     */
    protected $article;

    public function __toString()
    {
        $format = "Article (Id: %s, %s, %s)\n";
        return sprintf($format, $this->id, $this->user, $this->article);
    }

}