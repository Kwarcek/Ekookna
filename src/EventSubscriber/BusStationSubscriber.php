<?php

namespace App\EventSubscriber;

use App\Entity\BusStation;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BusStationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setReaded'],
        ];
    }

    public function setReaded(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        $entity->setReaded(true);
    }
}