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

use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use JMS\DiExtraBundle\Annotation\Observe;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SidebarSetupMenuListener
 * @package Sedona\SBOTestBundle
 * @Service("menu.listener")
  */
class SidebarSetupMenuListener
{
    /**
     * @param SidebarMenuEvent $event
     * @Observe("theme.sidebar_setup_menu")
     * @Observe("theme.breadcrumb")
     */
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }

    protected function getMenu(Request $request)
    {
        $earg      = array();
        $rootItems = array(
//            $usersLink = new MenuItemModel('users', 'admin.edit_users', 'admin_user_list', $earg, 'fa fa-users'),
            $editLink = new MenuItemModel('crud', 'admin.edit_contents', null, $earg, 'fa fa-edit'),
        );

//        $usersLink
//            ->addChild(new MenuItemModel('user', 'admin.user.entity_name', 'admin_user_list', $earg, 'fa fa-users'))
//            ;
        $editLink
            ->addChild(new MenuItemModel('artist', 'admin.artist.entity_name', 'admin_artist_list', $earg, 'fa fa-edit'))
            ->addChild(new MenuItemModel('album', 'admin.album.entity_name', 'admin_album_list', $earg, 'fa fa-edit'))
            ->addChild(new MenuItemModel('track', 'admin.track.entity_name', 'admin_track_list', $earg, 'fa fa-edit'))
            ;

        return $this->activateByRoute($request->get('_route'), $rootItems);

    }

    protected function activateByRoute($route, $items)
    {
        // First check exact match
        $found = false;
        foreach($items as $item) { /** @var $item MenuItemModel */
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            }
            else {
                if($item->getRoute() == $route) {
                    $item->setIsActive(true);
                    $found = true;
                }
            }
        }
        // Then check approx match admin_A_*
        if(!$found) {
            $routeElts = explode("_", $route);
            if($routeElts[0] == "admin" && count($routeElts) == 3) {
                foreach($items as $item) { /** @var $item MenuItemModel */
                    if($item->hasChildren()) {
                        $this->activateByRoute($route, $item->getChildren());
                    }
                    else {
                        $elts = explode("_", $item->getRoute());
                        if($elts[0] == "admin" && $elts[1] == $routeElts[1]) {
                            $item->setIsActive(true);
                        }
                    }
                }
            }

        }
        return $items;
    }


}
