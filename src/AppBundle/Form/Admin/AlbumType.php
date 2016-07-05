<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbumType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*  */
        $builder
            ->add('title', null, ['required' => true])
            ->add("date", "date", array('widget' => 'single_text', 'format' => "dd/MM/yyyy", 'required' => false))
            ->add("datetime", "datetime", array('widget' => 'single_text', 'format' => "dd/MM/yyyy HH:mm:ss", 'required' => false))
            ->add("time", "time", array('widget' => 'single_text', 'with_seconds' => true, 'required' => false))
        //   ->add("artist","collection_select2",[
        //           'class'             => 'AppBundle\Entity\Artist',
        //           'searchRouteName'   => 'admin_artist_search',
        //           'property'          => 'name',
        //           'required'          => false
        //       ])
        //   ->add("track","collection_select2",[
        //           'class'             => 'AppBundle\Entity\Track',
        //           'searchRouteName'   => 'admin_track_search',
        //           'property'          => 'title',
        //           'required'          => false
        //       ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Album'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_album';
    }
}
