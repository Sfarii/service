<?php

namespace ServiceBundle\Form\Administration;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use ServiceBundle\Entity\Administration\ContactUS;

class ContactUSType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => 'contactus.field.name'))
                ->add('email', TextType::class, array('label' => 'contactus.field.email'))
                ->add('message', TextareaType::class, array('label' => 'contactus.field.message'))
                ->add('save', SubmitType::class, array(
                    'attr' => ['button_type' => 'round'],
                    'label' => 'contactus.field.submit'
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ContactUS::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_administration_contactus';
    }


}
