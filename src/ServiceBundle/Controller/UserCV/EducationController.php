<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use ServiceBundle\Entity\UserCV\Education;
use ServiceBundle\Form\UserCV\EducationType;

/**
 * Education controller.
 *
 * @Route("usercv_education")
 */
class EducationController extends Controller
{
    /**
     * Lists all education entities.
     *
     * @Route("/", name="education_index")
     * @Method("GET")
     * @Template("UserCV/education/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
      $educations = $em->getRepository(Education::class)->findBy(array('user' => $this->getUser()));
      return array('educations' => $educations);
    }

    /**
     * Creates a new education entity.
     *
     * @Route("/new", name="education_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/education/new.html.twig")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
        $education = new Education();
        $form = $this->createForm(EducationType::class, $education, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($education);
            $em->flush();

            return new JsonResponse(array('msg' => $this->get('translator')->trans('education.new.success')), 200);
        }

        return array(
            'education' => $education,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing education entity.
     *
     * @Route("/{id}/edit", name="education_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/education/edit.html.twig")
     */
    public function editAction(Request $request, Education $education, EntityManagerInterface $em)
    {
        $editForm = $this->createForm(EducationType::class, $education, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return new JsonResponse(array('msg' => $this->get('translator')->trans('education.edit.success')), 200);
        }

        return array(
            'education' => $education,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a education entity.
     *
     * @Route("/{id}", name="education_delete")
     * @Method("DELETE")
     */
    public function deleteAction(EntityManagerInterface $em, Education $education)
    {
      try {
        $em->remove($education);
        $em->flush();
        return new JsonResponse(array('msg' => $this->get('translator')->trans('education.delete.success')), 200);
      } catch (\Exception $e) {
        return new JsonResponse(array('msg' => $this->get('translator')->trans('education.delete.fail')), 200);
      }
    }
}
