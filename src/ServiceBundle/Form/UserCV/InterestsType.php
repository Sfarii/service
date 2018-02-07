<?php

namespace ServiceBundle\Form\UserCV;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Vich\UploaderBundle\Form\Type\VichImageType;

use ServiceBundle\Entity\Administration\Alert;

use ServiceBundle\Entity\UserManagment\User as User;
use ServiceBundle\Entity\UserCV\Interests;

class InterestsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile',  VichImageType::class, array(
                'allow_delete' => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
                'label' => false)
            )
            ->add('title', TextType::class, array('label' => 'intrests.field.title'))
            ->add('submit', SubmitType::class ,array(
                'attr' => ['button_type' => 'round'],
                'label' => 'intrests.field.submit'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Interests::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_usercv_interests';
    }


}
