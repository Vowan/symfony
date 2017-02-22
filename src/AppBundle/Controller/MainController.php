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
     * @Route("/town/{name}/{region}", name="town")
     */
    public function townAction(Request $request, $name = 'Одеса', $region = 'Одеська область') {

      // dump($town,$region);       die();
//        
//        $user = $this->get('security.token_storage')->getToken()->getUser();
//
        
         $repository1 = $this->getDoctrine()->getRepository('AppBundle:Town');
         
         $town= $repository1->getTownByNameAndRegion($name, $region);

       // dump($town);        die();


        return $this->render('realty/town.html.twig', array(
                    'town' => $name,
                    'region' => $region,
        ));
    }
    
    /**
     * @Route("/ajax/{name}/{region}", name="ajax")
     */
    public function ajaxAction(Request $request, $name = 'Одеса', $region = 'Одеська область') {


       
         $user = $this->get('security.token_storage')->getToken()->getUser();

         $repository = $this->getDoctrine()->getRepository('AppBundle:Realty');

         $realties = $repository->getRealtiesForJson($name, $region);
        
        
     //   dump("ajax", $realties);        die();


       return $this->json(array('realties' => $realties));
    }

    /**
     * @Route("/proba", name="proba")
     */
    public function probaAction() {



        return $this->render('realty/town.html.twig', array(
                    'town' => 'Смотрич',
                    'region' => 'Хмельницька область',
        ));
    }

}
