<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserValidationCollectionFormType extends AbstractType
{
    const BASE_TRANSLATION_KEY = 'profile.edit.user_profile.fields.';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('users', 'collection', [
            'type'   => new UserValidationFormType(),
        ]);
    }

    public function getName()
    {
        return 'app_user_validation_collection';
    }
}
