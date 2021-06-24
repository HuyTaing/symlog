<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DashboardController extends AbstractController
{
    /**
     * @Route("/profile", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    /**
     * @Route("/profile/modifier-profile", name="dashboard.edit")
     */
    public function edit(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $oldPwd = $form->get('old_password')->getData();

            if($encoder->isPasswordValid($user, $oldPwd)){
                die('ça marche');

            }else {
                die('ça marche pas');
            }
        }   

        return $this->render('dashboard/edit.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
}
