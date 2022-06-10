<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;

class UserChangedNotifier
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event

    public function __construct( EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }
    public function postUpdate(User $user, LifecycleEventArgs $event): void
    {

        $event->setupdateAt(new \DateTimeImmutable());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        // ... do something to notify the changes
    }
}