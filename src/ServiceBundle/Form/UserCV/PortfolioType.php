<?php

namespace ServiceBundle\Form\UserCV;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

use ServiceBundle\FormType\MonthType;
use ServiceBundle\FormType\YearType;
use ServiceBundle\FormType\HiddenEntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;

use ServiceBundle\Entity\UserCV\Portfolio;
use ServiceBundle\Entity\UserManagment\User as User;

class PortfolioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
                ->add('imageFile',  VichImageType::class, array(
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                    'label' => false)
                )
                ->add('projectName', TextType::class, array('label' => 'portfolio.field.projectName'))
                ->add('fromYear', YearType::class, array('label' => 'portfolio.field.fromYear'))
                ->add('fromMonth', MonthType::class, array('label' => 'portfolio.field.fromMonth'))
                ->add('toMonth', MonthType::class, array('label' => 'portfolio.field.toMonth'))
                ->add('toYear', YearType::class, array('label' => 'portfolio.field.toYear'))
                ->add('projectOnGoing', CheckboxType::class, array('label' => 'portfolio.field.projectOnGoing'))
                ->add('projectURL', UrlType::class, array('label' => 'portfolio.field.projectURL'))
                ->add('description', TextareaType::class, array('label' => 'portfolio.field.description'))
                ->add('user', HiddenEntityType::class, array(
                      'class' => User::class,
                      'data' =>  $user,
                ))
                ->add('submit', SubmitType::class ,array(
                    'attr' => ['button_type' => 'normal'],
                    'label' => 'portfolio.field.submit'
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Portfolio::class
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_usercv_portfolio';
    }


}
