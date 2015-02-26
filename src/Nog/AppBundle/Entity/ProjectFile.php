<?php

namespace Nog\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * ProjectFile
 *
 * @ORM\Table("nog_project_files")
 * @ORM\Entity
 */
class ProjectFile
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="files", cascade={"persist"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
            
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }    
    
    
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
     * Set path
     *
     * @param string $name
     * @return ProjectFile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }    

    /**
     * Set project
     *
     * @param \Nog\AppBundle\Entity\Project $project
     * @return ProjectFile
     */
    public function setProject(\Nog\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;
        return $this;
    }

    /**
     * Get project
     *
     * @return \Nog\AppBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }
        
    public function getAbsolutePath()
    {
        $folder = $this->getProject()->getFolder();
        return $folder
            ? null
            : $this->getUploadRootDir().'/'.$folder;
    }

    public function getWebPath()
    {
        $folder = $this->getProject()->getFolder();
        return null === $folder
            ? null
            : $this->getUploadDir().'/'.$folder;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        //todo: move to config;
        return 'uploads/projects';
    }    
}
