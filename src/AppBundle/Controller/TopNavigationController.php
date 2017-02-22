<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TopNavigationController extends Controller
{
    public function topNavigationAction()
    {
        $nav_items = array('Киев'=>'Киевская область', 'Одесса'=>'Одесская область');

        return $this->render(
            'navigation/top-nav.html.twig',
            array('nav_items' => $nav_items)
        );
    }
}
