<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Picture;
use AppBundle\Entity\UserProfile;
use AppBundle\Form\Type\PictureFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;
use AppBundle\Form\Type\UserProfileFormType;

/**
 * Profile controller.
 *
 * @Route("/profile")
 **/
class ProfileController extends Controller
{
    /**
     * @param User $user
     *
     * @Config\Route("/{id}", name="cheerup_profile_view")
     * @Config\Template()
     *
     * @return array
     */
    public function indexAction(User $user)
    {
        return [
            'fullname' => $user->getFullName()
        ];
    }

    /**
     * @param Request $request
     * @Config\Route("/", name="cheerup_profile_edit")
     * @Config\Template()
     * @Config\Security("has_role('ROLE_USER')")
     *
     * @return array
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        /** @var UserProfile $userProfile */
        $userProfile           = $user->getUserProfile();
        $currentPictureWebPath = $userProfile->getPicture()->getWebPath();
        $picture               = new Picture();

        $formUserProfile = $this->createForm(new UserProfileFormType(), $userProfile);
        $formPicture     = $this->createForm(new PictureFormType(), $picture, ['validation_groups' => 'profile']);
        $formChangePassword = $this->container->get('fos_user.change_password.form');
        $formChangePasswordHandler = $this->container->get('fos_user.change_password.form.handler');

        $formUserProfile->handleRequest($request);
        $formPicture->handleRequest($request);
        $processChangePassword = $formChangePasswordHandler->process($user);

        if ($formUserProfile->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($userProfile);
            $em->flush();

            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.user_profile.success')
            );
        }
        if ($formPicture->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $userProfile->setPicture($picture);

            $em->persist($picture);
            $em->flush();

            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.picture.success')
            );
        }
        if ($processChangePassword) {
            $this->addFlash(
                'success',
                $this->get('translator')->trans('profile.edit.change_password.success')
            );
        }

        return [
            'current_picture_web_path' => $currentPictureWebPath,
            'form_user_profile'        => $formUserProfile->createView(),
            'form_picture'             => $formPicture->createView(),
            'form_change_password'     => $formChangePassword->createView(),
            'user'                     => $user,
        ];
    }
}
