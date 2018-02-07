<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use ServiceBundle\Form\UserCV\SoftwareType;
use ServiceBundle\Entity\UserCV\Software;

/**
 * Software controller.
 *
 * @Route("software")
 */
class SoftwareController extends Controller
{
    /**
     * Lists all software entities.
     *
     * @Route("/", name="software_index")
     * @Method("GET")
     * @Template("UserCV/software/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
      $softwares = $em->getRepository(Software::class)->findBy(array('user' => $this->getUser()));
      return array('softwares' => $softwares);
    }

    /**
     * Creates a new software entity.
     *
     * @Route("/new", name="software_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/software/new.html.twig")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
        $software = new Software();
        $form = $this->createForm(SoftwareType::class, $software, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($software);
            $em->flush();

            return new JsonResponse(array('msg' => $this->get('translator')->trans('software.new.success')), 200);
        }

        return array(
            'software' => $software,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing software entity.
     *
     * @Route("/{id}/edit", name="software_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/software/edit.html.twig")
     */
    public function editAction(Request $request, Software $software, EntityManagerInterface $em)
    {
        $editForm = $this->createForm(SoftwareType::class, $software, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return new JsonResponse(array('msg' => $this->get('translator')->trans('software.edit.success')), 200);
        }

        return array(
            'software' => $software,
            'form' => $editForm->createView()
        );
    }

    /**
     * Deletes a software entity.
     *
     * @Route("/{id}", name="software_delete")
     * @Method("DELETE")
     */
    public function deleteAction(EntityManagerInterface $em, Software $software)
    {
      try {
        $em->remove($software);
        $em->flush();
        return new JsonResponse(array('msg' => $this->get('translator')->trans('software.delete.success')), 200);
      } catch (\Exception $e) {
        return new JsonResponse(array('msg' => $this->get('translator')->trans('software.delete.fail')), 200);
      }
    }
}
