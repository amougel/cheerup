<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserValidationFormType extends AbstractType
{
    const BASE_TRANSLATION_KEY = 'profile.edit.user_profile.fields.';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('validated', 'checkbox', [
            'label'    => false,
            'required' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'app_user_validation';
    }
}
