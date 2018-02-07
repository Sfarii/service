<?php

namespace ServiceBundle\Form\UserCV;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use ServiceBundle\FormType\HiddenEntityType;
use ServiceBundle\FormType\SocialNetworkType;

use ServiceBundle\Entity\UserCV\SocialMedia;
use ServiceBundle\Entity\UserManagment\User as User;

class SocialMediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
              ->add('account', TextType::class, array('label' => 'socialmedia.field.account'))
              ->add('type', SocialNetworkType::class, array('label' => 'socialmedia.field.type'))
              ->add('user', HiddenEntityType::class, array(
                    'class' => User::class,
                    'data' =>  $user,
              ))
              ->add('submit', SubmitType::class ,array(
                  'attr' => ['button_type' => 'normal'],
                  'label' => 'socialmedia.field.submit'
              ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SocialMedia::class
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_usercv_socialmedia';
    }


}
