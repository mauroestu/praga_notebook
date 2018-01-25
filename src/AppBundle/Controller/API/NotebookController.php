<?php

namespace AppBundle\Controller\API;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Notebook;
use AppBundle\Form\NotebookType;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;

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
     * Create a new Notebook
     *
     * @Route("/api/notebook", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Create a new Notebook",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Notebook::class)
     *     )
     * )
     *
     * @SWG\Tag(name="rewards")
     */
    public function postNotebookAction(Request $request)
    {
        $notebook = new Notebook();
        $notebook->setEnabled(true);
        $notebook->setUser($this->getUser());
        $form = $this->createForm(new NotebookType(), $task);
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
        $data = array("fomr" => $form);

        $status = Response::HTTP_BAD_REQUEST;
        $view = $this->view($data, $status);

        return $this->handleView($view);
    }
}
