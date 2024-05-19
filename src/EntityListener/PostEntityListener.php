<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Prispevek;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Prispevek::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Prispevek::class)]
class PostEntityListener extends EntityListenerWithSlugger
{
    public function prePersist(Prispevek $post, LifecycleEventArgs $event): void
    {
        $post->createSlug($this->slugger);
    }

    public function preUpdate(Prispevek $post, LifecycleEventArgs $event): void
    {
        $post->createSlug($this->slugger);
    }
}