<?php

namespace ServiceBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AlertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'alert.danger'  => 'DANGER',
                'alert.info' => 'INFO',
                'alert.success' => 'SUCCESS',
                'alert.warning' => 'WARNING'
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
