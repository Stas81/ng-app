<?php
namespace Nog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Nog\AppBundle\Entity\ProjectFile;


/**
 * Project
 *
 * @ORM\Table("nog_projects")
 * @ORM\Entity(repositoryClass="Nog\AppBundle\Entity\ProjectRepository")
 */
class Project
{    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="folder", type="string", length=255)
     */    
    private $folder;

    /**
     * @ORM\OneToMany(targetEntity="ProjectFile", mappedBy="project")
     */
    private $files;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
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
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get folder
     *
     * @return string 
     */
    public function getFolder()
    {
        return $this->folder;
    }    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->folder = md5('uploadFolder'.rand().date('m-d-y').rand());
    }

    /**
     * Add files
     *
     * @param \Nog\AppBundle\Entity\ProjectFile $files
     * @return Project
     */
    public function addFile(ProjectFile $file)
    {
        $this->files[] = $file;
        return $this;
    }

    /**
     * Remove files
     *
     * @param \Nog\AppBundle\Entity\ProjectFile $files
     */
    public function removeFile(ProjectFile $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }
}
