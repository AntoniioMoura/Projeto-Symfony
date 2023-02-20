<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Template()
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return ['index'=>"ola"];
    }

    /**
     * @Route ("/pizzas")
     */
    public function pizzasAction(Request $request){
        $posts = $this->getDoctrine()->getRepository("AppBundle:Pizza")->findAll();
        return ['pizzas'=>$posts];
    }

    /**
     *@Route ("/sobre")
     */
    public function sobreAction(Request $request){
        return['sobre'=>"sobre"];
    }

    /**
     * @Route ("/users", name="user_database")
     */
    public function usersAction(){
        $posts = $this->getDoctrine()->getRepository("AppBundle:Post")->findAll();
        return ['users'=>$posts];
    }
}
