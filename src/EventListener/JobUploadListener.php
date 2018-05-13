<?php

namespace App\EventListener;

use \App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use \App\Entity\Job;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class JobUploadListener
{
    /**
     * @var FileUploader
     */
    private $uploader;

    /**
     * JobUploadListener constructor.
     * @param FileUploader $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param $entity
     * @throws \Exception
     */
    private function uploadFile($entity): void
    {
        // For Job entities only
        if ($entity instanceof Job) {
            $logoFile = $entity->getLogo();

            if ($logoFile instanceof UploadedFile) {
                $fileName = $this->uploader->upload($logoFile);
                $entity->setLogo($fileName);
            }
        }
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * @param $entity
     */
    public function stringToFile($entity): void
    {
        if ($entity instanceof Job) {
            $file = $this->uploader->getTargetDirectory() . '/' . $entity->getLogo();
            if ($entity->getLogo() && file_exists($file)) {
                $entity->setLogo(new File($file));
            }
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        $this->stringToFile($entity);
    }

    /**
     * @param $entity
     */
    public function fileToString($entity): void
    {
        if ($entity instanceof Job) {
            if (($file = $entity->getLogo()) instanceof File) {
                $entity->setLogo($file->getFilename());
            }
        }
    }

    /**
     * @param PreUpdateEventArgs $args
     * @throws \Exception
     */
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
        $this->fileToString($entity);
    }
}
