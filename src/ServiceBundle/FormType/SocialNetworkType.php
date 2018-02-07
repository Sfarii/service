<?php

namespace ServiceBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SocialNetworkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'social_network.type.site' => 'globe',
                'social_network.type.linkedin' => 'linkedin',
                'social_network.type.facebook' => 'facebook-official',
                'social_network.type.google_plus' => 'google-plus',
                'social_network.type.instagram' => 'instagram',
                'social_network.type.youtube' => 'youtube',
                'social_network.type.twitter' => 'twitter',
                'social_network.type.soundcloud' => 'soundcloud',
                'social_network.type.pinterest' => 'pinterest'
            ),
            'choice_translation_domain' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
