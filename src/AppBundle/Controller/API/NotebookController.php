<?php

namespace AppBundle\Controller\API;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Notebook;
use AppBundle\Entity\Type;
use AppBundle\Form\NotebookType;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NotebookController extends FOSRestController
{
    /**
     * @param Request $request
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return new Response('Prueba');
    }

    /**
     * @param Request $request
     *
     * @Rest\Post("/user/")
     */
    public function postNotebookAction(Request $request)
    {
        $notebook = new Notebook();
        $form = $this->createForm(new NotebookType(), $notebook);
        $notebook->setEnabled(true);
        $notebook->setUser($this->getUser());
        $em = $this->getDoctrine()->getEntityManager();
        $type = $em->getRepository("AppBundle:Type")->find(Type::CONST_MENTAL_NOTE);
        $notebook->setType($type);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $EntityManager = $this->getDoctrine()->getManager();
            $EntityManager->persist($notebook);
            $EntityManager->flush();

            $data = array("notebook" => $notebook);

            $status = Response::HTTP_CREATED;
            $view = $this->view($data, $status);

            return $this->handleView($view);
        }
        $data = array("form" => $form);

        $status = Response::HTTP_BAD_REQUEST;
        $view = $this->view($data, $status);

        return $this->handleView($view);
    }
}
