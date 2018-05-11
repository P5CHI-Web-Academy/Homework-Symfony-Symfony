<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use \App\Entity\Job;

class JobTokenListener
{
    /**
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if ($entity instanceof Job) {
            $entity->setToken(\bin2hex(\random_bytes(10)));
        }
    }
}
