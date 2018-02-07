<?php

namespace ServiceBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MonthType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
          'choices' => array(
              'month.january'   => '01',
              'month.february'  => '02',
              'month.march'     => '03',
              'month.april'     => '04',
              'month.may'       => '05',
              'month.june'      => '06',
              'month.july'      => '07',
              'month.august'    => '08',
              'month.september' => '09',
              'month.october'   => '10',
              'month.november'  => '11',
              'month.december'  => '12',
          )
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
