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
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use ServiceBundle\Entity\UserCV\Interests;
use ServiceBundle\Form\UserCV\InterestsType;
use ServiceBundle\Datatables\UserCV\InterestsDatatable;

/**
 * Interest controller.
 *
 * @Route("interests")
 * @Security("has_role('ROLE_USER')")
 */
class InterestController extends Controller
{
    /**
     * Lists all interest entities.
     *
     * @Route("/", name="interests_index")
     * @Method("GET")
     * @Template("UserCV/interests/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
        /** @var DatatableInterface $datatable */
        $interestsDatatable = $this->get('sg_datatables.factory')->create(InterestsDatatable::class);
        $interestsDatatable->buildDatatable();
        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($interestsDatatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            $datatableQueryBuilder->buildQuery();

            return $responseService->getResponse();
        }

        return array('interests' => $interestsDatatable);
    }

    /**
     * Creates a new interest entity.
     *
     * @Route("/new", name="interests_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/interests/new.html.twig")
     */
    public function newAction(Request $request, ServiceManagerInterface $sem)
    {
        $interest = new Interests();
        $form = $this->createForm(InterestsType::class, $interest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sem->insert($interest);
            $this->addFlash('msg_success', $this->get('translator')->trans('interests.new.success'));
            return $this->redirectToRoute('interests_index');
        }

        return array(
            'interest' => $interest,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing interest entity.
     *
     * @Route("/edit/{id}", name="interests_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/interests/edit.html.twig")
     */
    public function editAction(Request $request, Interests $interest, ServiceManagerInterface $sem)
    {
        $editForm = $this->createForm(InterestsType::class, $interest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sem->update($interest);
            $this->addFlash('msg_success', $this->get('translator')->trans('interests.edit.success'));
            return $this->redirectToRoute('interests_index');
        }

        return array(
            'interest' => $interest,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a interest entity.
     *
     * @Route("/delete", name="interests_bulk_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ServiceManagerInterface $sem)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            $choices = $request->request->get('data');
            $token = $request->request->get('token');

            if (!$this->isCsrfTokenValid('multiselect', $token)) {
                throw new AccessDeniedException('The CSRF token is invalid.');
            }

            try {
                $sem->deleteAllByID(Interests::class, $choices);
            } catch (\Exception $e) {
                return new Response($this->get('translator')->trans('interests.delete.fail'), 200);
            }


            return new Response($this->get('translator')->trans('interests.delete.success'), 200);
        }

        return new Response('Bad Request', 400);
    }
}
