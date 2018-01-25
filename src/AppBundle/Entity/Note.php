<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoteRepository")
 */
class Note
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=500)
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Notebook", inversedBy="notes")
     * @ORM\JoinColumn(name="notebook", referencedColumnName="id")
     */
    private $notebook;

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
     * Set note
     *
     * @param string $note
     *
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Note
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Note
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
     * Set notebook
     *
     * @param \AppBundle\Entity\Notebook $notebook
     *
     * @return Note
     */
    public function setNotebook(\AppBundle\Entity\Notebook $notebook = null)
    {
        $this->notebook = $notebook;

        return $this;
    }

    /**
     * Get notebook
     *
     * @return \AppBundle\Entity\Notebook
     */
    public function getNotebook()
    {
        return $this->notebook;
    }
}
