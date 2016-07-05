<?php

namespace AppBundle\Datatables;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class ArtistDatatable
 * @Service("admin_artist_datatable")
 * @Tag("sg.datatable.view")
 */
class ArtistDatatable extends AbstractCrudDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options= [])
    {
        $this->setParameters();
        $this->setColumns();

        $this->ajax->set(['url' => $this->router->generate('admin_artist_datatable')]);

        //$this->options->set(['individual_filtering' => true]); // Uncomment it to have a search for each field

        $actions = [];
        if ($this->router->getRouteCollection()->get('admin_artist_show') != null) {
            $actions[] = [
                'route' => 'admin_artist_show',
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
        if(count($actions)>0) {
            $this->getColumnBuilder()
                ->add(null, 'action', array(
                    'title' => 'Actions',
                    'actions' => $actions
                ));
        }
    }

    protected function setParameters() {
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
    protected function setColumns() {

        $this->getColumnBuilder()
            ->add('name', 'column', array('title' => $this->translator->trans('admin.artist.name', [], 'admin')))
            // ->add('biography', 'column', array('title' => $this->translator->trans('admin.artist.biography', [], 'admin'))) Text field, uncomment to add
            ->add('music_story_id', 'column', array('title' => $this->translator->trans('admin.artist.music_story_id', [], 'admin')))
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
