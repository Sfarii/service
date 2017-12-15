<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\BusinessDirectory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Form\BusinessDirectoryType;

/**
 * Businessdirectory controller.
 *
 * @Route("businessdirectory")
 */
class BusinessDirectoryController extends Controller
{
    /**
     * Lists all businessDirectory entities.
     *
     * @Route("/", name="businessdirectory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $businessDirectories = $em->getRepository('ServiceBundle:BusinessDirectory')->findAll();

        return $this->render('businessdirectory/index.html.twig', array(
            'businessDirectories' => $businessDirectories,
        ));
    }

    /**
     * Creates a new businessDirectory entity.
     *
     * @Route("/new", name="businessdirectory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $businessDirectory = new Businessdirectory();
        $form = $this->createForm(BusinessDirectoryType::class, $businessDirectory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($businessDirectory);
            $em->flush();

            return $this->redirectToRoute('businessdirectory_show', array('id' => $businessDirectory->getId()));
        }

        return $this->render('businessdirectory/new.html.twig', array(
            'businessDirectory' => $businessDirectory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a businessDirectory entity.
     *
     * @Route("/{id}", name="businessdirectory_show")
     * @Method("GET")
     */
    public function showAction(BusinessDirectory $businessDirectory)
    {
        $deleteForm = $this->createDeleteForm($businessDirectory);

        return $this->render('businessdirectory/show.html.twig', array(
            'businessDirectory' => $businessDirectory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing businessDirectory entity.
     *
     * @Route("/{id}/edit", name="businessdirectory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BusinessDirectory $businessDirectory)
    {
        $deleteForm = $this->createDeleteForm($businessDirectory);
        $editForm = $this->createForm( BusinessDirectoryType::class, $businessDirectory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('businessdirectory_edit', array('id' => $businessDirectory->getId()));
        }

        return $this->render('businessdirectory/edit.html.twig', array(
            'businessDirectory' => $businessDirectory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a businessDirectory entity.
     *
     * @Route("/{id}", name="businessdirectory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BusinessDirectory $businessDirectory)
    {
        $form = $this->createDeleteForm($businessDirectory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($businessDirectory);
            $em->flush();
        }

        return $this->redirectToRoute('businessdirectory_index');
    }

    /**
     * Creates a form to delete a businessDirectory entity.
     *
     * @param BusinessDirectory $businessDirectory The businessDirectory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BusinessDirectory $businessDirectory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('businessdirectory_delete', array('id' => $businessDirectory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
