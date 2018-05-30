<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="home")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/home.html.twig');
    }
    
    /**
     * @Route("/notfound", name="notfound")
     */
    public function notfoundAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/notfound.html.twig');
    }
}
