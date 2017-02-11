<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Realty;
use AppBundle\Form\RealtyFormType;

class RealtyController extends Controller {

    /**
     * @Route("/realty", name="new_realty")
     */
    public function realtyAction(Request $request) {

        $user = $this->getUser();
        $realty_type = $request->query->get('optradio');

        if (!$qqq = $this->get('app.form.type.task')->getRealtyType()) {

            $this->get('app.form.type.task')->setRealtyType($realty_type);
        }

        // dump($realty_type);        die();

        $town = 'Ukraine';

        // just setup a fresh $task object (remove the dummy data)
        $realty = new Realty();

 
        $form = $this->createForm(RealtyFormType::class, $realty);
        

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            // $form->getData() holds the submitted values
//            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            
            dump($task);            die();

          //
//            // ... perform some action, such as saving the task to the database
//            // for example, if Task is a Doctrine entity, save it!
//            // $em = $this->getDoctrine()->getManager();
//            // $em->persist($task);
//            // $em->flush();
//
//            return $this->redirectToRoute('task_success');
        } 
        
       

        return $this->render('realty/SellFlatType.html.twig', array('town' => $town,
                    'form' => $form->createView(),));
    }

}
