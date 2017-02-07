<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()
                ->getEntityManager();

        $blogs = $em->getRepository('BloggerBlogBundle:Blog')
                ->getLatestBlogs();

        return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
                    'blogs' => $blogs
        ));
    }

    public function aboutAction() {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

    public function contactAction(Request $request) {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);



        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page

                $this->addFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

                return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
            }
        }

        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
