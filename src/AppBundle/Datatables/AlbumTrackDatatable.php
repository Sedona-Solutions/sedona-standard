<?php

namespace AppBundle\Datatables;

use AppBundle\Entity\Album;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;

/**
 * Class AlbumDatatable.
 *
 * @Service("admin_album_track_datatable")
 * @Tag("sg.datatable.view")
 */
class AlbumTrackDatatable extends TrackDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = [])
    {
        $album = $options['entity'];

        if (!$album instanceof Album) {
            throw new \InvalidArgumentException(sprintf('Instance of Album expected, got %s', get_class($album)));
        }

        $this->setParameters();
        $this->setColumns();

        $this->ajax->set(['url' => $this->router->generate('admin_album_track_datatable', ['id' => $album->getId()])]);

        //$this->options->set(['individual_filtering' => true]); // Uncomment it to have a search for each field

        $actions = [];
        if ($this->router->getRouteCollection()->get('admin_track_show') != null) {
            $actions[] = [
                'route' => 'admin_track_show',
                'route_parameters' => array('id' => 'id'),
                'label' => $this->translator->trans('crud.title.show', [], 'admin'),
                'icon' => 'glyphicon glyphicon-book',
                'attributes' => array(
                    'rel' => 'tooltip',
                    'title' => $this->translator->trans('crud.title.show', [], 'admin'),
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'button',
                ),
            ];
        }
        if ($this->router->getRouteCollection()->get('admin_track_edit') != null) {
            $actions[] = [
                'route' => 'admin_track_edit',
                'route_parameters' => array('id' => 'id'),
                'label' => $this->translator->trans('crud.title.edit', [], 'admin'),
                'icon' => 'glyphicon glyphicon-edit',
                'attributes' => array(
                    'rel' => 'tooltip',
                    'title' => $this->translator->trans('crud.title.edit', [], 'admin'),
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'button',
                ),
            ];
        }
        if ($this->router->getRouteCollection()->get('admin_track_delete') != null) {
            $actions[] = [
                'route' => 'admin_album_track_remove',
                'route_parameters' => array('track_id' => 'id', 'id' => 'album.id'),
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
        if (count($actions) > 0) {
            // mappedBy > album | inversedBy > 
            $this->getColumnBuilder()
                ->add('album.id', 'column', ['visible' => false])
                ->add(null, 'action', array(
                    'title' => 'Actions',
                    'actions' => $actions,
                ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'album_track_datatable';
    }
}
