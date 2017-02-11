<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Form\RealtyembedType;
use AppBundle\Entity\Realtyembed;
use AppBundle\Entity\Room;


class ListController extends Controller {

    /**
     * @Route("/task", name="welcome1")
     */
    public function taskAction(Request $request) {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
                ->add('task', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('save', SubmitType::class, array('label' => 'Create Post'))
                ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted()) { //&& $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('default/new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/tasktype", name="tasktype")
     */
    public function tasktypeAction(Request $request) {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class);


        $form->handleRequest($request);

        if ($form->isSubmitted()) { //&& $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task1 = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('default/new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/formembed", name="formembed")
     */
    public function formembedAction(Request $request) {
        $task = new Realtyembed();

        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
        $tag1 = new Room();
        $tag1->setName('tag1');
        $task->getRooms()->add($tag1);
        $tag2 = new Room();
        $tag2->setName('tag2');
        $task->getRooms()->add($tag2);
        // end dummy code

        $form = $this->createForm(RealtyembedType::class, $task);
        
        

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... maybe do some form processing, like saving the Task and Tag objects
        }

        return $this->render('proba/form.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/task/success", name="task_success")
     */
    public function successAction(Request $request) {
        return $this->render('proba/form.html.twig');
    }

}
