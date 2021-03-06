<?php

namespace AppBundle\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sedona\SBORuntimeBundle\Form\Type as SBOType;

class AlbumType extends AbstractType
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
            ->add('date', SBOType\LocaleDateType::class, array('widget' => 'single_text', 'format' => 'MM/dd/yyyy', 'required' => false))
            ->add('datetime', SBOType\LocaleDateTimeType::class, array('widget' => 'single_text', 'format' => 'MM/dd/yyyy HH:mm:ss', 'required' => false))
            ->add('time', SBOType\LocaleTimeType::class, array('widget' => 'single_text', 'required' => false))
        //   ->add('artist', \Sedona\SBORuntimeBundle\Form\Type\EntitySelect2Type::class, [
        //           'class'             => 'AppBundle\Entity\Artist',
        //           'searchRouteName'   => 'admin_artist_search',
        //           'property'          => 'name',
        //           'required'          => false
        //       ])
        //   ->add('track', \Sedona\SBORuntimeBundle\Form\Type\EntitySelect2Type::class, [
        //           'class'             => 'AppBundle\Entity\Track',
        //           'searchRouteName'   => 'admin_track_search',
        //           'property'          => 'title',
        //           'required'          => false
        //       ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Album',
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'admin_album';
    }
}
