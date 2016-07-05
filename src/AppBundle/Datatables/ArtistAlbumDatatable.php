<?php

namespace AppBundle\Datatables;

use AppBundle\Entity\Artist;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class ArtistDatatable
 * @Service("admin_artist_album_datatable")
 * @Tag("sg.datatable.view")
 */
class ArtistAlbumDatatable extends AlbumDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = [])
    {
        $artist = $options['entity'];

        if (!$artist instanceof Artist) {
            throw new \InvalidArgumentException(sprintf('Instance of Artist expected, got %s', get_class($artist)));
        }

        $this->setParameters();
        $this->setColumns();

        $this->ajax->set(['url' => $this->router->generate('admin_artist_album_datatable',['id'=> $artist->getId()])]);

        //$this->options->set(['individual_filtering' => true]); // Uncomment it to have a search for each field

        $actions = [];
        if ($this->router->getRouteCollection()->get('admin_album_show') != null) {
            $actions[] = [
                'route' => 'admin_album_show',
                'route_parameters' => array('id' => 'id'),
                'label' => $this->translator->trans('crud.title.show', [], 'admin'),
                'icon' => 'glyphicon glyphicon-eye-open',
                'attributes' => array(
                    'rel' => 'tooltip',
                    'title' => 'Show',
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'button'
                )
            ];
        }
        if ($this->router->getRouteCollection()->get('admin_artist_album_remove') != null) {
            $actions[] = [
                'route' => 'admin_artist_album_remove',
                'route_parameters' => array('album_id' => 'id', 'id' => 'artist[0].id' ),
                'label' => $this->translator->trans('crud.form.delete', [], 'admin'),
                'icon' => 'glyphicon glyphicon-remove-circle',
                'attributes' => array(
                    'rel' => 'tooltip',
                    'title' => $this->translator->trans('crud.form.delete', [], 'admin'),
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'button',
                    'data-toggle' => 'delete',
                    'data-confirm' => $this->translator->trans('crud.form.confirm', [], 'admin'),
                ),
            ];
        }
        if(count($actions)>0) {
            // mappedBy > artist | inversedBy > 
            $this->getColumnBuilder()
                ->add('artist.id','column',['visible' => false])
                ->add(null, 'action', array(
                    'title' => 'Actions',
                    'actions' => $actions
                ));
        }

    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'artist_album_datatable';
    }
}
