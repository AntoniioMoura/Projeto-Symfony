<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Pizza;
use AppBundle\Entity\Post;
use AppBundle\Form\PizzaForm;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Template()
 * Class PostController
 * @package AppBundle\Controller
 */

class PostController extends Controller
{
    /**
     * @Route ("/create",name="post_create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $post = $form->getData();
            $password = $this->get('security.password_encoder')->encodePassword($post,$post->getPassword());
            $post->setPassword($password);
            $post->setRoles('ROLE_USER');
            $post->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
            $post->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $doctrine = $this->getDoctrine()->getEntityManager();
            $doctrine->persist($post);
            $doctrine->flush();
            $this->addFlash("success","Cadastro realizado com sucesso!");
            return $this->redirect('/login');
        }
        return ['form'=>$form->createView()];
    }

    /**
     * @Route ("/{id}/editar", name="post_edit" )
     */
    public function editAction(Post $post, Request $request)
    {
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $post = $form->getData();
            $post->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $doctrine = $this->getDoctrine()->getEntityManager();
            $doctrine->persist($post);
            $doctrine->flush();
            $this->addFlash("success","Cadastro editado com sucesso!");
            return $this->redirect('/users');
        }
        return ['form'=>$form->createView()];
    }

    /**
     * @Route ("/createpizza",name="criar_pizza")
     */
    public function createpizzaAction(Request $request){
        $form = $this->createForm(PizzaForm::class);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $post = $form->getData();
            $post->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
            $post->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $doctrine = $this->getDoctrine()->getEntityManager();
            $doctrine->persist($post);
            $doctrine->flush();
            $this->addFlash("success","Pizza cadastrada com sucesso!");
            return $this->redirect('/pizzas');
        }
        return ['form'=>$form->createView()];
    }

    /**
     * @Route ("/{id}/editpizza", name="edit_pizza" )
     */
    public function editpizzaAction(Pizza $post, Request $request)
    {
        $form = $this->createForm(PizzaForm::class,$post);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $post = $form->getData();
            $post->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $doctrine = $this->getDoctrine()->getEntityManager();
            $doctrine->persist($post);
            $doctrine->flush();
            $this->addFlash("success","Pizza editada com sucesso!");
            return $this->redirect('/pizzas');
        }
        return ['form'=>$form->createView()];
    }

    /**
     * @Route ("/remove/{post}", name="remove_user")
     * @Method({"GET", "POST"})
     */
    public function removeAction(Post $post){
        $this->getDoctrine()->getEntityManager()->remove($post);
        $this->getDoctrine()->getEntityManager()->flush();
        $this->addFlash("warning", "Usuário removido com sucesso!");
        return $this->redirect('/users');
    }

    /**
     * @Route ("/removepizza/{post}", name="remove_pizza")
     * @Method({"GET", "POST"})
     */
    public function removepizzaAction(Pizza $post){
        $this->getDoctrine()->getEntityManager()->remove($post);
        $this->getDoctrine()->getEntityManager()->flush();
        $this->addFlash("warning", "Pizza removida com sucesso!");
        return $this->redirect('/pizzas');
    }
}
