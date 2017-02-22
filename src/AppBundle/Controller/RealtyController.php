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

        $uuid_factory = $this->container->get('kherge_uuid.uuid_factory');

        $uuid = $uuid_factory->uuid4()->toString();

        $realty->setUuid($uuid);

        $form = $this->createForm(RealtyFormType::class, $realty);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//  
            $realty = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($realty);

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            

              return $this->redirectToRoute('town', array(
                  'town' => $realty->getTown()->getName(),
                  'region'=>$realty->getTown()->getRegion()
                  ));
        }



        return $this->render('realty/SellFlatType.html.twig', array('town' => $town,
                    'form' => $form->createView(),));
    }

}
