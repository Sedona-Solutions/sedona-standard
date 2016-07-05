<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Track;
use AppBundle\Form\Admin\TrackType;
use AppBundle\Entity\Album;

/**
 * Track controller.
 *
 * @Route("/track")
 */
class TrackController extends BaseCrudController
{
    protected $route_name = 'admin_track';
    protected $bundle_name = 'AppBundle';
    protected $entity_name = 'Track';

    /**
     * Lists all Track entities.
     *
     * @Route("/", name="admin_track_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->manageIndex();
    }

    /**
     * JSON call for datatable to list all Track entities.
     *
     * @Route("/datatable", name="admin_track_datatable")
     * @Method("GET")
     */
    public function datatableAction()
    {
        return $this->manageDatatableJson();
    }

    /**
    * Create a new Track.
    *
    * @Route("/new", name="admin_track_new", options={"expose"=true})
    */
    public function newAction(Request $request)
    {
        return $this->manageNew(new Track(), $request, new TrackType());
    }

    /**
    * search Track.
    *
    * @Route("/searchAlbum", name="admin_track_album_search", options={"expose"=true})
    *
    * @return JsonResponse
    */
    public function searchAlbumAction(Request $request)
    {
        return $this->searchSelect2($request, 'AppBundle\Entity\Album', 'title');
    }        
    /**
    * Edit a Track.
    *
    * @Route("/{id}/edit", name="admin_track_edit", options={"expose"=true})
    */
    public function editAction(Track $entity, Request $request)
    {
        return $this->manageEdit($entity, $request, new TrackType());
    }

    /**
    * Show a Track.
    *
    * @Route("/{id}", name="admin_track_show", options={"expose"=true})
    * @Method("GET")
    */
    public function showAction(Track $entity)
    {
        return $this->manageShow($entity);
    }



}