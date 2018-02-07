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

use ServiceBundle\Entity\UserCV\Education;
use ServiceBundle\Entity\UserManagment\User as User;

class EducationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder->add('school', TextType::class, array('label' => 'education.field.school'))
                ->add('degree', TextType::class, array('label' => 'education.field.degree'))
                ->add('fieldOfStudy', TextType::class, array('label' => 'education.field.fieldOfStudy'))
                ->add('grade', TextType::class, array('label' => 'education.field.grade'))
                ->add('description', TextareaType::class, array('label' => 'education.field.description'))
                ->add('fromYear', YearType::class, array('label' => 'education.field.fromYear'))
                ->add('toYear', YearType::class, array('label' => 'education.field.toYear'))
                ->add('user', HiddenEntityType::class, array(
                      'class' => User::class,
                      'data' =>  $user,
                ))
                ->add('submit', SubmitType::class ,array(
                    'attr' => ['button_type' => 'normal'],
                    'label' => 'education.field.submit'
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Education::class
        ));
        $resolver->setRequired('user');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_usercv_education';
    }


}
