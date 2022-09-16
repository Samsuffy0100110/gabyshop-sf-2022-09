<?php

namespace App\Event\NewsLetter;

use DateTimeImmutable;
use App\Entity\Communication\NewsLetter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class DateNewsLetter implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDate'],
        ];
    }

    public function setDate(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof NewsLetter)) {
            return;
        }

        $entity->setCreatedAt(new DateTimeImmutable());
    }
}
