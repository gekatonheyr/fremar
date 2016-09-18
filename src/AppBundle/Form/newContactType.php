<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class newContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['entity_manager'];
        $districts_list = array();
        $repo = $em->getRepository('AppBundle:Districts');
        $db_answer = $repo->findAll();
        foreach ($db_answer as $item) {
            $districts_list[$item->getDistrictName()] = $item->getDistrictName();
        }
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('telNumber', TextType::class)
            ->add('emailAddress', TextType::class)
            ->add('resPlaceName', TextType::class)
            ->add('resPlaceDistrict', ChoiceType::class, array('placeholder'=>'Please select your choice',
                'choices' => $districts_list))
            ->add('resPlaceStreet', ChoiceType::class, array('placeholder'=>'Please select your choice',
                ))
            ->add('resPlaceHouseNumber', TextType::class)
            ->add('resPlaceAppartNumber', TextType::class)
            ->add('saveAndRet2Cat', SubmitType::class, array('label'=>'Save data and return to catalog'))
            ->add('saveAndAddAnother', SubmitType::class, array('label'=>'Save and add another contact'))
            ->add('clearData', SubmitType::class, array('label'=>'Clear data'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'Appbundle\Entity\Contacts'));
        $resolver->setRequired('entity_manager');
    }

    public function getName()
    {
        return 'app_bundlenew_contact_type';
    }
}
