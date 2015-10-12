<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheerupPositionCollectionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cheerupPositions', 'collection', [
            'type'   => new CheerupPositionFormType(),
        ]);
    }

    public function getName()
    {
        return 'app_cheerup_position_collection';
    }
}
