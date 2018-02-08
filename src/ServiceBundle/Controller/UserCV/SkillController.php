<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ServiceBundle\Form\UserCV\SkillType;
use ServiceBundle\Entity\UserCV\Skill;


/**
 * Skill controller.
 *
 * @Route("skill")
 * @Security("has_role('ROLE_USER')")
 */
class SkillController extends Controller
{
    /**
     * Lists all skill entities.
     *
     * @Route("/", name="skill_index")
     * @Method("GET")
     * @Template("UserCV/skill/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $skills = $em->getRepository(Skill::class)->findBy(array('user' => $this->getUser()));
        return array('skills' => $skills);
    }

    /**
     * Creates a new skill entity.
     *
     * @Route("/new", name="skill_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/skill/new.html.twig")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($skill);
            $em->flush();

            return new JsonResponse(array('msg' => $this->get('translator')->trans('experience.new.success')), 200);
        }

        return array(
            'skill' => $skill,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing skill entity.
     *
     * @Route("/{id}/edit", name="skill_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/skill/edit.html.twig")
     */
    public function editAction(Request $request, Skill $skill, EntityManagerInterface $em)
    {
        $editForm = $this->createForm(SkillType::class, $skill, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return new JsonResponse(array('msg' => $this->get('translator')->trans('skill.edit.success')), 200);
        }

        return array(
            'skill' => $skill,
            'form' => $editForm->createView()
        );
    }

    /**
     * Deletes a skill entity.
     *
     * @Route("/{id}", name="skill_delete")
     * @Method("DELETE")
     */
    public function deleteAction(EntityManagerInterface $em, Skill $skill)
    {
      try {
        $em->remove($skill);
        $em->flush();
        return new JsonResponse(array('msg' => $this->get('translator')->trans('education.delete.success')), 200);
      } catch (\Exception $e) {
        return new JsonResponse(array('msg' => $this->get('translator')->trans('education.delete.fail')), 200);
      }
    }
}
