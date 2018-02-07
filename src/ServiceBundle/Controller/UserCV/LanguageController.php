<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use ServiceBundle\Services\ServiceManagerInterface;
use ServiceBundle\Form\UserCV\LanguageType;
use ServiceBundle\Entity\UserCV\Language;

/**
 * Language controller.
 *
 * @Route("language")
 */
class LanguageController extends Controller
{
    /**
     * Lists all language entities.
     *
     * @Route("/", name="language_index")
     * @Method("GET")
     * @Template("UserCV/language/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $languages = $em->getRepository(Language::class)->findBy(array('user' => $this->getUser()));
        return array('languages' => $languages);
    }

    /**
     * Creates a new language entity.
     *
     * @Route("/new", name="language_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/language/new.html.twig")
     */
    public function newAction(Request $request, ServiceManagerInterface $em)
    {
        $language = new Language();
        $form = $this->createForm(LanguageType::class, $language, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->insert($language);

            return new JsonResponse(array('msg' => $this->get('translator')->trans('language.new.success')), 200);
        }

        return array(
            'language' => $language,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new language entity.
     *
     * @Route("/edit/{id}", name="language_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/language/edit.html.twig")
     */
    public function editAction(Request $request, Language $language, ServiceManagerInterface $sem)
    {
        $editForm = $this->createForm(LanguageType::class, $language, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sem->update($language);
            return new JsonResponse(array('msg' => $this->get('translator')->trans('language.edit.success')), 200);
        }

        return array(
            'language' => $language,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a language entity.
     *
     * @Route("/{id}", name="language_delete")
     * @Method("DELETE")
     */
    public function deleteAction(ServiceManagerInterface $em, Language $language)
    {
      try {
        $em->delete($language);
        return new JsonResponse(array('msg' => $this->get('translator')->trans('language.delete.success')), 200);
      } catch (\Exception $e) {
        return new JsonResponse(array('msg' => $this->get('translator')->trans('language.delete.fail')), 200);
      }
    }
}
