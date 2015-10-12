<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheerupPositionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateOptons = [
            'label'  => false,
            'html5'  => false,
            'widget' => 'single_text',
            'attr'   => ['class' => 'form-control actual_range']
        ];

        $builder->add('startDate', 'date', $dateOptons)
            ->add('endDate', 'date', $dateOptons)
            ->add(
                'title',
                null,
                [
                    'label' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\CheerupPosition',
            ]
        );
    }

    public function getName()
    {
        return 'app_cheerup_position';
    }
}
