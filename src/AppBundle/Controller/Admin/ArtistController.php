<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Artist;
use AppBundle\Form\Type\Admin\ArtistType;
use AppBundle\Entity\Album;

/**
 * Artist controller.
 *
 * @Route("/artist")
 */
class ArtistController extends BaseCrudController
{
    protected $route_name = 'admin_artist';
    protected $bundle_name = 'AppBundle';
    protected $entity_name = 'Artist';

    /**
     * Lists all Artist entities.
     *
     * @Route("/", name="admin_artist_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->manageIndex();
    }

    /**
     * JSON call for datatable to list all Artist entities.
     *
     * @Route("/datatable", name="admin_artist_datatable")
     * @Method("GET")
     */
    public function datatableAction()
    {
        return $this->manageDatatableJson();
    }

    /**
     * Create a new Artist.
     *
     * @Route("/new", name="admin_artist_new", options={"expose"=true})
     */
    public function newAction(Request $request)
    {
        return $this->manageNew(new Artist(), $request, ArtistType::class);
    }

    /**
     * Edit a Artist.
     *
     * @Route("/{id}/edit", name="admin_artist_edit", options={"expose"=true})
     */
    public function editAction(Artist $entity, Request $request)
    {
        return $this->manageEdit($entity, $request, ArtistType::class);
    }

    /**
     * Show a Artist.
     *
     * @Route("/{id}", name="admin_artist_show", options={"expose"=true})
     * @Method("GET")
     */
    public function showAction(Artist $entity)
    {
        return $this->manageShow($entity);
    }

    /**
     * Lists all Album entities for property album of entity Artist.
     *
     * @Route("/{id}/listAlbum", name="admin_artist_album_list", options={"expose"=true})
     * @Method("GET")
     */
    public function indexAlbumAction(Artist $artist)
    {
        return $this->manageFieldIndex($artist, 'album');
    }

    /**
     * JSON call for datatable to list all Album entities for property album of entity Artist.
     *
     * @Route("/{id}/datatableAlbum", name="admin_artist_album_datatable", options={"expose"=true})
     * @Method("GET")
     */
    public function datatableAlbumAction(Artist $artist)
    {
        return $this->manageFieldDatatableJson($artist, 'album', 'artist', 'many');
    }

    /**
     * Search album for entity Artist.
     *
     * @Route("/{id}/searchAlbum", name="admin_artist_album_search", options={"expose"=true})
     */
    public function searchAlbumAction(Request $request, Artist $artist)
    {
        return $this->manageSearchFieldMany($request, $artist, 'AppBundle\Entity\Album', 'album', 'title');
    }

    /**
     * Add relation Artist to album.
     *
     * @Route("/{id}/addAlbum/{album_id}", name="admin_artist_album_add", options={"expose"=true})
     * @ParamConverter("album", class="AppBundle\Entity\Album", options={"id" = "album_id"})
     */
    public function addAlbumAction(Artist $artist, Album $album)
    {
        return $this->manageJson($artist, $album, 'album', 'addAlbum', false);
    }

    /**
     * Remove relation Artist to album.
     *
     * @Route("/{id}/removeAlbum/{album_id}", name="admin_artist_album_remove", options={"expose"=true})
     * @ParamConverter("album", class="AppBundle\Entity\Album", options={"id" = "album_id"})
     */
    public function removeAlbumAction(Artist $artist, Album $album)
    {
        return $this->manageJson($artist, $album, 'album', 'removeAlbum', true);
    }
}
