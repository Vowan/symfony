<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller {

    /**
     * @Route("/", name="main")
     */
    public function mainAction(Request $request) {
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        //dump($user);        die();
       
        $town = 'Ukraine';

        return $this->render('default/index.html.twig', array('town' => $town));
    }
    
    /**
     * @Route("/town/{town}", name="town")
     */ 
    
    public function townAction(Request $request, $town='Kiev') {
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        //dump($user);        die();
       

        return $this->render('default/index.html.twig', array('town' => $town));
    }


}
