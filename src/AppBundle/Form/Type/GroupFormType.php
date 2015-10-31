<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Aggregate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'admin.index.group.create.field.name'
            ])
            ->add('description', null, [
                'label' => 'admin.index.group.create.field.description'
            ])
            ->add('offshoot', 'choice', [
                'label' => 'admin.index.group.create.field.offshoot',
                'choices' => [
                    true => 'admin.index.group.create.field.is_offshoot',
                    false => 'admin.index.group.create.field.is_not_offshoot',
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Group'
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_group';
    }
}
