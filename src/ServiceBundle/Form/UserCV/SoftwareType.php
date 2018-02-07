<?php

namespace ServiceBundle\Form\UserCV;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use ServiceBundle\FormType\HiddenEntityType;

use ServiceBundle\Entity\UserCV\Software;
use ServiceBundle\Entity\UserManagment\User as User;

class SoftwareType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder->add('skill', TextType::class, array('label' => 'software.field.skill'))
                ->add('progress', NumberType::class, array('label' => 'software.field.progress', 'attr' => ['class' => 'range_slider']))
                ->add('user', HiddenEntityType::class, array(
                      'class' => User::class,
                      'data' =>  $user,
                ))
                ->add('submit', SubmitType::class ,array(
                    'attr' => ['button_type' => 'normal'],
                    'label' => 'software.field.submit'
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Software::class
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_usercv_software';
    }


}
