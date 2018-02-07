<?php

namespace ServiceBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use ServiceBundle\Entity\UserManagment\User;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return RegistrationFormType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
