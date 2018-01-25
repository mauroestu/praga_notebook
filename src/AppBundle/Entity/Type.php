<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeRepository")
 */
class Type
{

    const CONST_MENTAL_NOTE = 1;
    const CONST_ENTERTAINMENT_NOTE = 2;
    const CONST_ACADEMIC_NOTE = 3;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


    /**
     * @ORM\OneToMany(targetEntity="Notebook", mappedBy="type")
     */
    private $notebooks;


    /**
    *Set id
    *
    *@param int $id
    *
    *@return id
    */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Type
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Type
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notebooks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add notebook
     *
     * @param \AppBundle\Entity\Notebook $notebook
     *
     * @return Type
     */
    public function addNotebook(\LibretaBundle\Entity\Notebook $notebook)
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
