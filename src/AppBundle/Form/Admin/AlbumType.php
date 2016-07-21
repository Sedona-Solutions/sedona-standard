<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;

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
            ->add('date', Type\DateType::class, array('widget' => 'single_text', 'format' => 'MM/dd/yyyy', 'required' => false))
            ->add('datetime', Type\DateTimeType::class, array('widget' => 'single_text', 'format' => 'MM/dd/yyyy HH:mm:ss', 'required' => false))
            ->add('time', Type\TimeType::class, array('widget' => 'single_text', 'with_seconds' => true, 'required' => false))
        //   ->add("artist", \Sedona\SBORuntimeBundle\Form\Type\EntitySelect2Type::class, [
        //           'class'             => 'AppBundle\Entity\Artist',
        //           'searchRouteName'   => 'admin_artist_search',
        //           'property'          => 'name',
        //           'required'          => false
        //       ])
        //   ->add("track", \Sedona\SBORuntimeBundle\Form\Type\EntitySelect2Type::class, [
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
