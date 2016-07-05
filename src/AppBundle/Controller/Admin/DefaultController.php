<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="admin_home" )
     */
    public function indexAction()
    {
        return $this->render("AppBundle:Admin/Default:index.html.twig", array());
    }

}
