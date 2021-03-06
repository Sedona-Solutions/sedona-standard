<?php

namespace AppBundle\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*  */
        $builder
            ->add('title', null, ['required' => false])
            ->add('album', \Sedona\SBORuntimeBundle\Form\Type\EntitySelect2Type::class, [
                   'class' => 'AppBundle\Entity\Album',
                   'searchRouteName' => 'admin_track_album_search',
                   'property' => 'title',
                   'placeholder' => 'search_placeholder',
                   'required' => false,
               ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Track',
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'admin_track';
    }
}
