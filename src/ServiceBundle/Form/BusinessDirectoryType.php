<?php

namespace ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusinessDirectoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class, array('label' => 'search.business_directory.company_name'))
            ->add('companyAddress', TextType::class, array('label' => 'search.business_directory.company_address'))
            ->add('longitude', TextType::class, array('label' => 'search.business_directory.longitude'))
            ->add('latitude', TextType::class, array('label' => 'search.business_directory.latitude'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ServiceBundle\Entity\BusinessDirectory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_businessdirectory';
    }
}
