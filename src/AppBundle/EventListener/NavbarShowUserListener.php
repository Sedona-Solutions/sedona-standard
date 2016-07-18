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

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Observe;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Service("showuser.listener")
 */
class NavbarShowUserListener
{
    protected $token_storage;

    /**
     * @InjectParams({
     "token_storage": @Inject("security.token_storage")
     * })
     */
    public function __construct(TokenStorageInterface $token_storage)
    {
        $this->token_storage = $token_storage;
    }

    /**
     * @Observe("theme.navbar_user")
     * //Observe("theme.sidebar_user")
     *
     * @param ShowUserEvent $event
     */
    public function onShowUser(ShowUserEvent $event)
    {
        $event->setUser($this->getUser());
    }

    protected function getUser()
    {
        return $this->token_storage->getToken()->getUser();
    }
}
