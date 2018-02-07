<?php

namespace ServiceBundle\Form\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use ServiceBundle\Entity\Administration\Alert;
use ServiceBundle\Entity\UserManagment\User;

use ServiceBundle\FormType\AlertType as AlertTypeField;

class AlertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array('label' => 'alert.field.title'))
                ->add('description', TextType::class, array('label' => 'alert.field.description'))
                ->add('type', AlertTypeField::class, array('label' => 'alert.field.type'))
                ->add('users', EntityType::class, array(
                    'class' => User::class,
                    'label' => false,
                    'multiple' => true,
                    // use the User.username property as the visible option string
                    'choice_label' => 'username',
                    'attr' => [ 'placeholder' => 'alert.field.user']
                    )
                )
                ->add('submit', SubmitType::class ,array(
                    'attr' => ['button_type' => 'round'],
                    'label' => 'alert.field.submit'
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Alert::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_administration_alert';
    }


}
