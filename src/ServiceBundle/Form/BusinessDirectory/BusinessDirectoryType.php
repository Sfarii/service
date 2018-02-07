<?php

namespace ServiceBundle\Form\BusinessDirectory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ServiceBundle\FormType\SectorType;

use ServiceBundle\Entity\BusinessDirectory\Sector;
use ServiceBundle\Entity\BusinessDirectory\BusinessDirectory;

class BusinessDirectoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class, array('label' => 'business_directory.field.company_name'))
            ->add('sector', SectorType::class, array(
                'label' => false,
                'attr' => [ 'placeholder' => 'business_directory.field.sector']
                )
            )
            ->add('companyAddress', TextType::class, array(
              'label' => 'business_directory.field.company_address',
              'attr' => ['placeholder' => ' '],
            ))
            ->add('longitude', TextType::class, array('label' => 'business_directory.field.longitude'))
            ->add('latitude', TextType::class, array('label' => 'business_directory.field.latitude'))
            ->add('save', SubmitType::class, array(
                'attr' => ['button_type' => 'square', 'class' => 'md-btn md-btn-small md-btn-flat md-btn-flat-primary'],
                'label' => 'business_directory.field.submit'
            ))
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
