<?php

namespace App\EventListener;

use App\Entity\Job;
use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class JobFileUploadListener
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * JobFileUploadListener constructor.
     *
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {

        $this->fileUploader = $fileUploader;
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadLogo($entity);
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadLogo($entity);
    }

    /**
     * @param $entity
     * @throws \Exception
     */
    private function uploadLogo($entity)
    {
        if (!$entity instanceof Job) {
            return;
        }

        $jobLogo = $entity->getLogo();

        if ($jobLogo instanceof UploadedFile) {
            $fileName = $this->fileUploader->upload($jobLogo);

            $entity->setLogo($fileName);
        }
    }
}
