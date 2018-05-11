<?php

namespace App\EventListener;

use \App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use \App\Entity\Job;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class JobUploadListener
{
    /**
     * @var FileUploader
     */
    private $uploader;

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
}
