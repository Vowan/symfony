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
     * @Route("/town/{town}/{region}", name="town")
     */
    public function townAction(Request $request, $town = 'Одеса', $region = 'Одеська область') {

      // dump($town,$region);       die();
//        
//        $user = $this->get('security.token_storage')->getToken()->getUser();
//
         $repository = $this->getDoctrine()->getRepository('AppBundle:Realty');
//
         $realties = $repository->getRealtiesByTownAndRegion($town, $region);
        
         $repository1 = $this->getDoctrine()->getRepository('AppBundle:Town');
         
         $town= $repository1->find(2);

        dump($realties);        die();


        return $this->render('default/town.html.twig', array(
                    'realties' => $realties,
                    'town' => $town,
                    'region' => $region,
        ));
    }

    /**
     * @Route("/proba", name="proba")
     */
    public function probaAction() {



        return $this->render('realty/town.html.twig', array(
                    'town' => 'Смотрич',
                    'region' => 'Хмельницкая область',
        ));
    }

}
