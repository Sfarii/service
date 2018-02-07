<?php

namespace ServiceBundle\Form\UserCV;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType as LanguageTypeForm;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use ServiceBundle\FormType\HiddenEntityType;
use ServiceBundle\FormType\ProficiencyType;
use ServiceBundle\Entity\UserCV\Language;
use ServiceBundle\Entity\UserManagment\User as User;

class LanguageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder->add('language', TextType::class, array('label' => 'language.field.language'))
                  ->add('proficiency', TextType::class, array('label' => 'language.field.proficiency', 'attr' => ['class' => 'range_slider']))
                  ->add('user', HiddenEntityType::class, array(
                        'class' => User::class,
                        'data' =>  $user,
                  ))
                  ->add('submit', SubmitType::class ,array(
                      'attr' => ['button_type' => 'normal'],
                      'label' => 'language.field.submit'
                  ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Language::class
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_usercv_language';
    }
}
