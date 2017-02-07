<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller {

    /**
     * @Route("/ajax/{action}", name="ajax")
     */
    public function ajaxAction(Request $request, $action) {
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        //dump($user);        die();
       
        $town = 'Ukraine';

        return $this->render('default/index.html.twig', array('town' => $town));
    }
  

}
