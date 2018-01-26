<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Notebook", mappedBy="user")
     */
    protected $notebooks;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->notebooks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add notebook
     *
     * @param \AppBundle\Entity\Notebook $notebook
     *
     * @return User
     */
    public function addNotebook(\AppBundle\Entity\Notebook $notebook)
    {
        $this->notebooks[] = $notebook;
        return $this;
    }
    /**
     * Remove notebook
     *
     * @param \AppBundle\Entity\Notebook $notebook
     */
    public function removeNotebook(\AppBundle\Entity\Notebook $notebook)
    {
        $this->notebooks->removeElement($notebook);
    }
    /**
     * Get notebooks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotebooks()
    {
        return $this->notebooks;
    }
}
