<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use ServiceBundle\Services\ServiceManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ServiceBundle\Entity\UserCV\SocialMedia;
use ServiceBundle\Form\UserCV\SocialMediaType;


/**
 * Socialmedia controller.
 *
 * @Route("usercv_socialmedia")
 * @Security("has_role('ROLE_USER')")
 */
class SocialMediaController extends Controller
{
    /**
     * Lists all socialMedia entities.
     *
     * @Route("/", name="socialmedia_index")
     * @Method("GET")
     * @Template("UserCV/socialmedia/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $socialMedia = $em->getRepository(SocialMedia::class)->findBy(array('user' => $this->getUser()));
        return array('socialMedias' => $socialMedia);
    }

    /**
     * Creates a new socialMedia entity.
     *
     * @Route("/new", name="socialmedia_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/socialmedia/new.html.twig")
     */
    public function newAction(Request $request, ServiceManagerInterface $sem)
    {
        $socialMedia = new Socialmedia();
        $form = $this->createForm(SocialMediaType::class, $socialMedia, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sem->insert($socialMedia);

            return new JsonResponse(array('msg' => $this->get('translator')->trans('socialmedia.new.success')), 200);
        }

        return array(
            'socialMedia' => $socialMedia,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing socialMedia entity.
     *
     * @Route("/{id}/edit", name="socialmedia_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/socialmedia/edit.html.twig")
     */
    public function editAction(Request $request, SocialMedia $socialMedia, ServiceManagerInterface $sem)
    {
        $editForm = $this->createForm(SocialmediaType::class, $socialMedia, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sem->update($socialMedia);
            return new JsonResponse(array('msg' => $this->get('translator')->trans('socialmedia.edit.success')), 200);
        }

        return array(
            'socialMedia' => $socialMedia,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a socialMedia entity.
     *
     * @Route("/{id}", name="socialmedia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(SocialMedia $socialMedia, ServiceManagerInterface $sem, Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            try {
                $sem->delete($socialMedia);
            } catch (\Exception $e) {
                return new JsonResponse(array('msg' => $this->get('translator')->trans('socialmedia.delete.fail')), 200);
            }
            return new JsonResponse(array('msg' => $this->get('translator')->trans('socialmedia.delete.success')), 200);
        }
        return new JsonResponse(array('msg' => 'Bad Request'), 400);
    }
}
