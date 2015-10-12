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
        $builder->add('startDate', null, [
            'label'    => false,
        ])->add('endDate', null, [
            'label'    => false,
        ])->add('description', null, [
            'label'    => false,
        ])->add('title', null, [
            'label'    => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CheerupPosition',
        ));
    }

    public function getName()
    {
        return 'app_cheerup_position';
    }
}
