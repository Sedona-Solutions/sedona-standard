<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrackType extends AbstractType
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
            ->add("album", "entity_select2", [
                   'class'             => 'AppBundle\Entity\Album',
                   'searchRouteName'   => 'admin_track_album_search',
                   'property'          => 'title',
                   'placeholder'       => 'search_placeholder',
                   'required'          => false
               ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Track'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_track';
    }
}
