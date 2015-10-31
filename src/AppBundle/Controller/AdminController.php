<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Form\Type\GroupFormType;
use AppBundle\Form\Type\UserValidationCollectionFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Profile controller.
 *
 * @Route("/admin")
 **/
class AdminController extends Controller
{
    /**
     * @param Request $request
     *
     * @Config\Route("/", name="cheerup_admin_index")
     * @Config\Template()
     * @Config\Security("has_role('ROLE_ADMIN')")
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $group                        = new Group();
        $formGroup                    = $this->createForm(new GroupFormType(), $group);
        $userRepository               = $this->get('doctrine')->getRepository('UserBundle:User');
        $notValidatedUsers            = $userRepository->findBy(['validated' => false]);
        $formUserValidationCollection =
            $this->createForm(new UserValidationCollectionFormType(), ['users' => $notValidatedUsers]);

        $formGroup->handleRequest($request);
        $formUserValidationCollection->handleRequest($request);

        if ($formGroup->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
            $this->addFlash(
                'success',
                $this->get('translator')->trans('admin.index.group.create.success')
            );
        }

        if ($formUserValidationCollection->isValid()) {
            // If delete button was pressed, then we delete the selected users
            $em = $this->getDoctrine()->getManager();
            $action = 'validate';
            if ($request->request->has('delete')) {
                $action = 'delete';
                foreach ($notValidatedUsers as $notValidatedUser) {
                    if($notValidatedUser->isValidated()) {
                        $em->remove($notValidatedUser);
                    }
                }
            }
            $em->flush();

            // Update user table, but keep old users
            $beforeSubmitNotValidatedUsers = $notValidatedUsers;
            $notValidatedUsers             = $userRepository->findBy(['validated' => false]);

            // Handle plural and singular success messages
            $nbOfValidatedUsers = count($beforeSubmitNotValidatedUsers) - count($notValidatedUsers);
            $translator         = $this->get('translator');
            if ($nbOfValidatedUsers == 1) {
                $successMessage = $translator->trans(
                    'admin.index.user_validation.success.sing.'.$action, [
                        '%nb_of_users%' => count($beforeSubmitNotValidatedUsers) - count($notValidatedUsers)
                ]);
                $this->addFlash('success', $successMessage);
            }
            if ($nbOfValidatedUsers > 1) {
                $successMessage = $translator->trans(
                    'admin.index.user_validation.success.plural.'.$action, [
                        '%nb_of_users%' => count($beforeSubmitNotValidatedUsers) - count($notValidatedUsers)
                ]);
                $this->addFlash('success', $successMessage);
            }

            // Hide validated users
            $formUserValidationCollection =
                $this->createForm(new UserValidationCollectionFormType(), ['users' => $notValidatedUsers]);
        }

        return [
            'form_group'                      => $formGroup->createView(),
            'form_user_validation_collection' => $formUserValidationCollection->createView()
        ];
    }
}
