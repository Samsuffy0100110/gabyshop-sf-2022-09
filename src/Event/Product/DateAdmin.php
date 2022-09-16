<?php

namespace App\Event\Product;

use DateTimeImmutable;
use App\Entity\Product\Product;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class DateAdmin implements EventSubscriberInterface
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

        if (!($entity instanceof Product)) {
            return;
        }

        $entity->setCreatedAt(new DateTimeImmutable());
    }
}
