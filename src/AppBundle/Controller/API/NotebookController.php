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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


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
     *
     * @Route("/api")
     */
    public function getNotebookAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
        /*$restresult = $this->getDoctrine()->getRepository('AppBundle:Notebook')->findAll();

        if ($restresult == null) {
          return new View(array("message" => "There are not Notebooks to show."), Response::HTTP_NOT_FOUND);
        }

        return new View($restresult, Response::HTTP_OK);*/
    }

    /**
     * @param Request $request
     *
     * @Rest\Post("/api/post")
     */
    public function postNotebookAction(Request $request)
    {
        $notebook = new Notebook();
        $name = $request->get('name');
        $description = $request->get('description');
        $user = $this->getUser();
        $idType = $request->get('type');
        $type = $this->getDoctrine()->getRepository('AppBundle:Type')->find($idType);

        $notebook->setName($name);
        $notebook->setDescription($description);
        $notebook->setUser($user);
        $notebook->setType($type);
        $notebook->setEnabled(true);

        $EntityManager = $this->getDoctrine()->getManager();
        $EntityManager->persist($notebook);
        $EntityManager->flush();

        return new View(array("message" => "Notebook Created"), Response::HTTP_OK);
    }
}
