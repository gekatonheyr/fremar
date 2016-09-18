<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class showContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('telNumber', TextType::class)
            ->add('emailAddress', TextType::class)
            ->add('resPlaceName', TextType::class)
            ->add('resPlaceDistrict', TextType::class)
            ->add('resPlaceStreet', TextType::class)
            ->add('resPlaceHouseNumber', TextType::class)
            ->add('resPlaceAppartNumber', TextType::class)
            ->add('editEntry', SubmitType::class, array('label'=>'Edit'))
            ->add('deleteEntry', SubmitType::class, array('label'=>'Delete'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'Appbundle\Entity\Contacts'));
    }

    public function getName()
    {
        return 'app_bundleshow_contact';
    }
}
