<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use ServiceBundle\Form\UserCV\ExperienceType;
use ServiceBundle\Entity\UserCV\Experience;

/**
 * Experience controller.
 *
 * @Route("usercv_experience")
 */
class ExperienceController extends Controller
{
    /**
     * Lists all experience entities.
     *
     * @Route("/", name="experience_index")
     * @Method("GET")
     * @Template("UserCV/experience/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $experiences = $em->getRepository(Experience::class)->findBy(array('user' => $this->getUser()));
        return array('experiences' => $experiences);
    }

    /**
     * Creates a new experience entity.
     *
     * @Route("/new", name="experience_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/experience/new.html.twig")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($experience);
            $em->flush();
            return new JsonResponse(array('msg' => $this->get('translator')->trans('experience.new.success')), 200);
        }

        return array(
            'experience' => $experience,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing experience entity.
     *
     * @Route("/{id}/edit", name="experience_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/experience/edit.html.twig")
     */
    public function editAction(Request $request, Experience $experience, EntityManagerInterface $em)
    {
        $editForm = $this->createForm(ExperienceType::class, $experience, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return new JsonResponse(array('msg' => $this->get('translator')->trans('experience.edit.success')), 200);
        }

        return array(
            'experience' => $experience,
            'form' => $editForm->createView()
        );
    }

    /**
     * Deletes a experience entity.
     *
     * @Route("/{id}", name="experience_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Experience $experience, EntityManagerInterface $em)
    {
        try {
          $em->remove($experience);
          $em->flush();
          return new JsonResponse(array('msg' => $this->get('translator')->trans('experience.delete.success')), 200);
        } catch (\Exception $e) {
          return new JsonResponse(array('msg' => $this->get('translator')->trans('experience.delete.fail')), 200);
        }
    }
}
