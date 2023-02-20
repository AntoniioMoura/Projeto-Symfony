<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Template()
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends Controller
{
    /**
     * @Route ("/login",name="login")
     */
    public function loginAction(Request $request){
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return
            ['last_username' => $lastUsername,
                'error' => $error,
            ];
    }

    /**
     * @Route ("/new-user", name="new_user")
     */

    public function newAction(Request $request){
        $user = new Post();

        $password = $this->get('security.password_encoder')->encodePassword($user,'123456');
        $user->setPassword($password);



        $user->setNome("Antonio");
        $user->setEndereco('Rua do User');
        $user->setTelefone('99999');
        $user->setRoles('ROLE_ADMIN');
        $user->setEmail('antonio@gmail.com');
        $user->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $user->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $doctrine = $this->getDoctrine();
        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();
    }
}
