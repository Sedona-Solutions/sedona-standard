<?php

namespace AppBundle\Datatables;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class ArtistDatatable.
 *
 * @Service("admin_artist_datatable")
 * @Tag("sg.datatable.view")
 */
class ArtistDatatable extends AbstractCrudDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = [])
    {
        $this->setParameters();
        $this->setColumns();

        $this->ajax->set(['url' => $this->router->generate('admin_artist_datatable')]);

        //$this->options->set(['individual_filtering' => true]); // Uncomment it to have a search for each field

        $actions = [];
        if ($this->router->getRouteCollection()->get('admin_artist_show')) {
            $actions[] = [
                'route' => 'admin_artist_show',
                'route_parameters' => array('id' => 'id'),
                'label' => $this->translator->trans('crud.title.show', [], 'admin'),
                'icon' => 'glyphicon glyphicon-eye-open',
                'attributes' => array(
                    'rel' => 'tooltip',
                    'title' => 'Show',
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'button',
                ),
            ];
        }

        if ($this->router->getRouteCollection()->get('admin_artist_edit')) {
            $actions[] = [
                'route' => 'admin_artist_edit',
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

        if ($this->router->getRouteCollection()->get('admin_artist_delete')) {
            $actions[] = [
                'route' => 'admin_artist_delete',
                'route_parameters' => array('id' => 'id'),
                'label' => $this->translator->trans('crud.title.delete', [], 'admin'),
                'icon' => 'glyphicon glyphicon-remove-circle',
                'attributes' => array(
                    'rel' => 'tooltip',
                    'title' => $this->translator->trans('crud.title.delete', [], 'admin'),
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'button',
                    'data-toggle' => 'delete',
                    'data-confirm' => $this->translator->trans('crud.form.confirm', [], 'admin'),
                ),
            ];
        }

        if (count($actions) > 0) {
            $this->getColumnBuilder()
                ->add(null, 'action', array(
                    'title' => 'Actions',
                    'actions' => $actions,
                ));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function setParameters()
    {
        $this->features->set([
            'server_side' => true,
            'processing' => true,
        ]);
        $this->options->set([
            'class' => Style::BOOTSTRAP_3_STYLE,
            'use_integration_options' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function setColumns()
    {
        $this->getColumnBuilder()
            ->add('name', 'column', array('title' => $this->translator->trans('admin.artist.name', [], 'admin')))
            // ->add('biography', 'column', array('title' => $this->translator->trans('admin.artist.biography', [], 'admin'))) Text field, uncomment to add
            ->add('external_id', 'column', array('title' => $this->translator->trans('admin.artist.external_id', [], 'admin')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'AppBundle:Artist';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'artist_datatable';
    }
}
