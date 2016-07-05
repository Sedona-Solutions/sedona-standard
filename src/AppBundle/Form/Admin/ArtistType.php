<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtistType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*  */
        $builder
            ->add('name', null, ['required' => true])
            ->add('biography', 'ckeditor', ['required' => false])
            ->add('music_story_id', null, ['required' => false])
        //   ->add("album","collection_select2",[
        //           'class'             => 'AppBundle\Entity\Album',
        //           'searchRouteName'   => 'admin_album_search',
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
            'data_class' => 'AppBundle\Entity\Artist'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_artist';
    }
}
