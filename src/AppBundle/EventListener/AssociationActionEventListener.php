<?php

/*
 * This file is part of sedona-standard.
 *
 * (c) Sedona <http://www.sedona.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use JMS\DiExtraBundle\Annotation\Observe;
use JMS\DiExtraBundle\Annotation\Service;
use Sedona\SBORuntimeBundle\Event\AdminAssociationActionEvent;

/**
 * Class AssociationActionEventListener.
 *
 * @Service("association.listener")
 */
class AssociationActionEventListener
{
    /**
     * Method called before flush.
     *
     * @Observe("sbo.association.preAction")
     *
     * @param AdminAssociationActionEvent $event
     */
    public function onCrudEventPre(AdminAssociationActionEvent $event)
    {
        // Do something BEFORE adding/removing
    }

    /**
     * Method called after flush.
     *
     * @Observe("sbo.association.postAction")
     *
     * @param AdminAssociationActionEvent $event
     */
    public function onCrudEventPost(AdminAssociationActionEvent $event)
    {
        // Do something AFTER adding/removing
    }
}
