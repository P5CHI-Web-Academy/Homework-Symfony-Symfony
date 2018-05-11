<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Job;
use App\Service\FileUploader;

class JobFileUploadListener
{
    /** @var FileUploader */
    private $uploader;

    /**
     * @param FileUploader $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * @param PreUpdateEventArgs $args
     * @throws \Exception
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
        $this->fileToString($entity);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->stringToFile($entity);
    }

    /**
     * @param $entity
     * @throws \Exception
     */
    private function uploadFile($entity)
    {
        if (!$entity instanceof Job) {
            return;
        }

        $logoFile = $entity->getLogo();

        if ($logoFile instanceof UploadedFile) {
            $fileName = $this->uploader->upload($logoFile);

            $entity->setLogo($fileName);
        }
    }

    /**
     * @param $entity
     */
    private function stringToFile($entity)
    {
        if (!$entity instanceof Job) {
            return;
        }

        if ($fileName = $entity->getLogo()) {
            $file = $this->uploader->getFile($fileName);

            $entity->setLogo($file);
        }
    }

    /**
     * @param $entity
     */
    private function fileToString($entity)
    {
        if (!$entity instanceof Job) {
            return;
        }

        $logoFile = $entity->getLogo();

        if ($logoFile instanceof File) {
            $entity->setLogo($logoFile->getFilename());
        }
    }
}
