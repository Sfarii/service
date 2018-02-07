<?php

namespace ServiceBundle\Form\UserCV;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use ServiceBundle\FormType\MonthType;
use ServiceBundle\FormType\YearType;
use ServiceBundle\FormType\HiddenEntityType;

use ServiceBundle\Entity\UserCV\Experience;
use ServiceBundle\Entity\UserManagment\User as User;

class ExperienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
            ->add('title', TextType::class, array('label' => 'experience.field.title'))
            ->add('company', TextType::class, array('label' => 'experience.field.company'))
            ->add('location', TextType::class, array('label' => 'experience.field.location'))
            ->add('description', TextareaType::class, array('label' => 'experience.field.description'))
            ->add('fromYear', YearType::class, array('label' => 'experience.field.fromYear'))
            ->add('fromMonth', MonthType::class, array('label' => 'experience.field.fromMonth'))
            ->add('toYear', YearType::class, array('label' => 'experience.field.toYear'))
            ->add('toMonth', MonthType::class, array('label' => 'experience.field.toMonth'))
            ->add('currentlyWorkHere', CheckboxType::class, array('label' => 'experience.field.currently_work_here'))
            ->add('user', HiddenEntityType::class, array(
                  'class' => User::class,
                  'data' =>  $user,
            ))
            ->add('submit', SubmitType::class ,array(
                'attr' => ['button_type' => 'normal'],
                'label' => 'experience.field.submit'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Experience::class
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_experience';
    }


}
