<?php

/*
 * This file is part of sedona-sbo Demo.
 *
 * (c) Sedona <http://www.sedona.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use JMS\DiExtraBundle\Annotation\Observe;
use JMS\DiExtraBundle\Annotation\Service;
use Sedona\SBORuntimeBundle\Event\AdminCrudEvent;

/**
 * Class CrudEventListener.
 *
 * @Service("crud.listener")
 */
class CrudEventListener
{
    /**
     * Method called before flush.
     *
     * @Observe("sbo.crud.preAction")
     *
     * @param AdminCrudEvent $event
     */
    public function onCrudEventPre(AdminCrudEvent $event)
    {
        switch ($event->getAction()) {
            case AdminCrudEvent::CREATE:
                // Do something BEFORE creating
                break;
            case AdminCrudEvent::UPDATE:
                // Do something BEFORE updating
                break;
            case AdminCrudEvent::DELETE:
                // Do something BEFORE deleting
                break;
        }
    }

    /**
     * Method called after flush.
     *
     * @Observe("sbo.crud.postAction")
     *
     * @param AdminCrudEvent $event
     */
    public function onCrudEventPost(AdminCrudEvent $event)
    {
        switch ($event->getAction()) {
            case AdminCrudEvent::CREATE:
                // Do something AFTER creating
                break;
            case AdminCrudEvent::UPDATE:
                // Do something AFTER updating
                break;
            case AdminCrudEvent::DELETE:
                // Do something AFTER deleting
                break;
        }
    }
}
