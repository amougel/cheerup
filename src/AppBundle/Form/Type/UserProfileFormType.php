<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserProfileFormType extends AbstractType
{
    const BASE_TRANSLATION_KEY = 'profile.edit.user_profile.fields.';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstYearContact', 'number', $this->getOptionsWithPlaceholder('first_year_contact'))
            ->add('address', null, $this->getOptionsWithPlaceholder('address'))
            ->add('additionalAddressDetails', null, $this->getOptionsWithPlaceholder('additional_address_details'))
            ->add('zipCode', 'number', $this->getOptionsWithPlaceholder('zip_code'))
            ->add('city', null, $this->getOptionsWithPlaceholder('city'))
            ->add('facebookProfile', 'url', $this->getOptionsWithPlaceholder('facebook_profile'))
            ->add('twitterProfile', 'url', $this->getOptionsWithPlaceholder('twitter_profile'))
            ->add('linkedInProfile', 'url', $this->getOptionsWithPlaceholder('linked_in_profile'))
            ->add('personalWebsite', 'url', $this->getOptionsWithPlaceholder('personal_website'))
            ->add('phoneNumber', 'number', $this->getOptionsWithPlaceholder('phone_number'))
            ->add('cellphoneNumber', 'number', $this->getOptionsWithPlaceholder('cellphone_number'));
    }

    public function getName()
    {
        return 'app_user_profile_edit';
    }

    /**
     * @param $translationKey
     *
     * @return array
     */
    private function getOptionsWithPlaceholder($translationKey)
    {
        return [
            'attr'     => [
                'placeholder' => $this::BASE_TRANSLATION_KEY.$translationKey.'.placeholder',
            ],
            'label'    => $this::BASE_TRANSLATION_KEY.$translationKey.'.label',
            'required' => false
        ];
    }
}
