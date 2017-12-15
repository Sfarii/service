<?php

namespace ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ServiceBundle\Entity\Sector;
use ServiceBundle\Entity\BusinessDirectory;

class BusinessDirectoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class, array('label' => 'business_directory.field.company_name'))
            ->add('sector', EntityType::class, array(
                'class' => Sector::class,
                // use the User.username property as the visible option string
                'choice_label' => 'sectorName',
                'attr' => [ 'placeholder' => 'business_directory.field.sector']
                )
            )
            ->add('companyAddress', TextType::class, array('label' => 'business_directory.field.company_address'))
            ->add('longitude', TextType::class, array('label' => 'business_directory.field.longitude'))
            ->add('latitude', TextType::class, array('label' => 'business_directory.field.latitude'))
            ->add('save', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BusinessDirectory::class
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
