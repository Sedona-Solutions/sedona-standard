<?php

namespace AppBundle\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*  */
        $builder
            ->add('name', null, ['required' => false])
            ->add('biography', \Trsteel\CkeditorBundle\Form\Type\CkeditorType::class, ['required' => false])
            ->add('external_id', null, ['required' => false])
        //   ->add("album", \Sedona\SBORuntimeBundle\Form\Type\EntitySelect2Type::class, [
        //           'class'             => 'AppBundle\Entity\Album',
        //           'searchRouteName'   => 'admin_album_search',
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
            'data_class' => 'AppBundle\Entity\Artist',
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'admin_artist';
    }
}
