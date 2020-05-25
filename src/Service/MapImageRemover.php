<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MapImageRemover
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function remove($file)
    {

        try {
            unlink($this->getTargetDirectory()."/".$file);
        } catch (FileException $e) {
            return false;
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}