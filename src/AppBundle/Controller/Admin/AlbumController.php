<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Album;
use AppBundle\Form\Admin\AlbumType;
use AppBundle\Entity\Artist;
use AppBundle\Entity\Track;

/**
 * Album controller.
 *
 * @Route("/album")
 */
class AlbumController extends BaseCrudController
{
    protected $route_name = 'admin_album';
    protected $bundle_name = 'AppBundle';
    protected $entity_name = 'Album';

    /**
     * Lists all Album entities.
     *
     * @Route("/", name="admin_album_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->manageIndex();
    }

    /**
     * JSON call for datatable to list all Album entities.
     *
     * @Route("/datatable", name="admin_album_datatable")
     * @Method("GET")
     */
    public function datatableAction()
    {
        return $this->manageDatatableJson();
    }

    /**
    * Create a new Album.
    *
    * @Route("/new", name="admin_album_new", options={"expose"=true})
    */
    public function newAction(Request $request)
    {
        return $this->manageNew(new Album(), $request, AlbumType::class);
    }

    /**
    * Edit a Album.
    *
    * @Route("/{id}/edit", name="admin_album_edit", options={"expose"=true})
    */
    public function editAction(Album $entity, Request $request)
    {
        return $this->manageEdit($entity, $request, AlbumType::class);
    }

    /**
    * Show a Album.
    *
    * @Route("/{id}", name="admin_album_show", options={"expose"=true})
    * @Method("GET")
    */
    public function showAction(Album $entity)
    {
        return $this->manageShow($entity);
    }

            
    /**
     * Lists all Artist entities for property artist of entity Album.
     *
     * @Route("/{id}/listArtist", name="admin_album_artist_list", options={"expose"=true})
     * @Method("GET")
     */
    public function indexArtistAction(Album $album)
    {
        return $this->manageFieldIndex($album, 'artist');
    }

    /**
     * JSON call for datatable to list all Artist entities for property artist of entity Album.
     *
     * @Route("/{id}/datatableArtist", name="admin_album_artist_datatable", options={"expose"=true})
     * @Method("GET")
     */
    public function datatableArtistAction(Album $album)
    {
        return $this->manageFieldDatatableJson($album, 'artist', 'album', 'many');
    }

    /**
     * Search artist for entity Album.
     *
     * @Route("/{id}/searchArtist", name="admin_album_artist_search", options={"expose"=true})
     */
    public function searchArtistAction(Request $request, Album $album)
    {
        return $this->manageSearchFieldMany($request, $album, 'AppBundle\Entity\Artist', 'artist', 'name');
    }
            
    /**
     * Add relation Album to artist.
     *
     * @Route("/{id}/addArtist/{artist_id}", name="admin_album_artist_add", options={"expose"=true})
     * @ParamConverter("artist", class="AppBundle\Entity\Artist", options={"id" = "artist_id"})
     */
    public function addArtistAction(Album $album, Artist $artist)
    {
        return $this->manageJson($album, $artist, 'artist', 'addArtist', false);
    }

            
    /**
     * Remove relation Album to artist.
     *
     * @Route("/{id}/removeArtist/{artist_id}", name="admin_album_artist_remove", options={"expose"=true})
     * @ParamConverter("artist", class="AppBundle\Entity\Artist", options={"id" = "artist_id"})
     */
    public function removeArtistAction(Album $album, Artist $artist)
    {
        return $this->manageJson($album, $artist, 'artist', 'removeArtist', true);
    }
    
            
    /**
     * Lists all Track entities for property track of entity Album.
     *
     * @Route("/{id}/listTrack", name="admin_album_track_list", options={"expose"=true})
     * @Method("GET")
     */
    public function indexTrackAction(Album $album)
    {
        return $this->manageFieldIndex($album, 'track');
    }

    /**
     * JSON call for datatable to list all Track entities for property track of entity Album.
     *
     * @Route("/{id}/datatableTrack", name="admin_album_track_datatable", options={"expose"=true})
     * @Method("GET")
     */
    public function datatableTrackAction(Album $album)
    {
        return $this->manageFieldDatatableJson($album, 'track', 'album', 'one');
    }

    /**
     * Search track for entity Album.
     *
     * @Route("/{id}/searchTrack", name="admin_album_track_search", options={"expose"=true})
     */
    public function searchTrackAction(Request $request, Album $album)
    {
        return $this->manageSearchFieldMany($request, $album, 'AppBundle\Entity\Track', 'track', 'title');
    }
            
    /**
     * Add relation Album to track.
     *
     * @Route("/{id}/addTrack/{track_id}", name="admin_album_track_add", options={"expose"=true})
     * @ParamConverter("track", class="AppBundle\Entity\Track", options={"id" = "track_id"})
     */
    public function addTrackAction(Album $album, Track $track)
    {
        return $this->manageJson($album, $track, 'track', 'addTrack', false);
    }

            
    /**
     * Remove relation Album to track.
     *
     * @Route("/{id}/removeTrack/{track_id}", name="admin_album_track_remove", options={"expose"=true})
     * @ParamConverter("track", class="AppBundle\Entity\Track", options={"id" = "track_id"})
     */
    public function removeTrackAction(Album $album, Track $track)
    {
        return $this->manageJson($album, $track, 'track', 'removeTrack', true);
    }
    


}