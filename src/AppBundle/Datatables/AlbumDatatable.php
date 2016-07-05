<?php

namespace AppBundle\Datatables;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class AlbumDatatable
 * @Service("admin_album_datatable")
 * @Tag("sg.datatable.view")
 */
class AlbumDatatable extends AbstractCrudDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options= [])
    {
        $this->setParameters();
        $this->setColumns();

        $this->ajax->set(['url' => $this->router->generate('admin_album_datatable')]);

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
            ->add('title', 'column', array('title' => $this->translator->trans('admin.album.title', [], 'admin')))
            ->add('date', 'datetime', array('title' => $this->translator->trans('admin.album.date', [], 'admin'), 'date_format' => 'L'))
            ->add('datetime', 'datetime', array('title' => $this->translator->trans('admin.album.datetime', [], 'admin'), 'date_format' => 'L LTS'))
            ->add('time', 'datetime', array('title' => $this->translator->trans('admin.album.time', [], 'admin'), 'date_format' => 'LTS'))
        ;
    }

    /**
    * {@inheritdoc}
    */
    public function getEntity()
    {
        return 'AppBundle:Album';
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'album_datatable';
    }
}
