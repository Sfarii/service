<?php

namespace ServiceBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as FOSProfileFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class ProfileFormType extends AbstractType
{
    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('imageFile',  VichImageType::class, array(
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                    'label' => false)
                )
                ->add('firstName', TextType::class, array('label' => 'user.field.first_name'))
                ->add('lastName', TextType::class, array('label' => 'user.field.last_name'))
                ->add('birthday', DateType::class,
                  array(
                    'label' => 'user.field.birthday',
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [ 'data-uk-datepicker'=> "{format:'YYYY-MM-DD'}"],
                  )
                )
                ->add('summary', TextareaType::class, array('label' => 'user.field.summary'))
                ->add('currentPosition', TextType::class, array('label' => 'user.field.current_position'))
                ->add('phone', TextType::class, array('label' => 'user.field.phone'))
                ->add('country', CountryType::class, array('label' => 'user.field.country'))
                ->add('codeZIP', TextType::class, array('label' => 'user.field.code_zip'))
                ->add('address', TextareaType::class, array('label' => 'user.field.address'))
              ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return FOSProfileFormType::class ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'service_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
