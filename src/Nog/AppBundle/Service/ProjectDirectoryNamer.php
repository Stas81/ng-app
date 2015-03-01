<?php
namespace Nog\AppBundle\Service;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Nog\AppBundle\Entity\ProjectFile;

class ProjectDirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($object, Propertymapping $mapping) 
    {
        $directory = '';
        if ($object instanceof ProjectFile){
            $directory = $object->getProject()->getFolder();
        }
        return $directory;
    }
}
