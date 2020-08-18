<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\BusStation;

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
        var_dump($event);
    }
}