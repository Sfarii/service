<?php

namespace ServiceBundle\Controller\BusinessDirectory;

use ServiceBundle\Entity\BusinessDirectory\BusinessDirectory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

use ServiceBundle\Services\ServiceManagerInterface;
use ServiceBundle\Form\BusinessDirectory\BusinessDirectoryType;
use ServiceBundle\Datatables\BusinessDirectory\BusinessDirectoryDatatable;

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
     * @Template("BusinessDirectory/businessdirectory/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
        /** @var DatatableInterface $datatable */
        $businessDirectorieDatatable = $this->get('sg_datatables.factory')->create(BusinessDirectoryDatatable::class);
        $businessDirectorieDatatable->buildDatatable();
        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($businessDirectorieDatatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            $datatableQueryBuilder->buildQuery();

            return $responseService->getResponse();
        }

        return array('businessDirectories' => $businessDirectorieDatatable);
    }

    /**
     * Creates a new businessDirectory entity.
     *
     * @Route("/new", name="businessdirectory_new")
     * @Method({"GET", "POST"})
     * @Template("BusinessDirectory/businessdirectory/new.html.twig")
     */
    public function newAction(Request $request, ServiceManagerInterface $sem)
    {
        $businessDirectory = new Businessdirectory();
        $form = $this->createForm(BusinessDirectoryType::class, $businessDirectory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sem->insert($businessDirectory);
            $this->addFlash('msg_success', $this->get('translator')->trans('business_directory.new.success'));
            return $this->redirectToRoute('homepage');
        }

        return array(
            'businessDirectory' => $businessDirectory,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a businessDirectory entity.
     *
     * @Route("/{id}", name="businessdirectory_show")
     * @Method("GET")
     * @Template("BusinessDirectory/businessdirectory/show.html.twig")
     */
    public function showAction(BusinessDirectory $businessDirectory)
    {
        return array(
            'businessDirectory' => $businessDirectory
        );
    }

    /**
     * Displays a form to edit an existing businessDirectory entity.
     *
     * @Route("/{id}/edit", name="businessdirectory_edit")
     * @Method({"GET", "POST"})
     * @Template("BusinessDirectory/businessdirectory/edit.html.twig")
     */
    public function editAction(Request $request, BusinessDirectory $businessDirectory)
    {
        $editForm = $this->createForm(BusinessDirectoryType::class, $businessDirectory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sem->insert($businessDirectory);
            $this->addFlash('msg_success', $this->get('translator')->trans('business_directory.edit.success'));

            return $this->redirectToRoute('businessdirectory_edit', array('id' => $businessDirectory->getId()));
        }

        return array(
            'businessDirectory' => $businessDirectory,
            'form' => $editForm->createView()
        );
    }

    /**
     * Bulk delete action.
     *
     * @param Request $request
     *
     * @Route("/bulk/delete", name="businessdirectory_bulk_delete")
     * @Method("DELETE")
     *
     * @return Response
     */
    public function bulkDeleteAction(Request $request, ServiceManagerInterface $sem)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            $choices = $request->request->get('data');
            $token = $request->request->get('token');

            if (!$this->isCsrfTokenValid('multiselect', $token)) {
                throw new AccessDeniedException('The CSRF token is invalid.');
            }

            try {
                $sem->deleteAllByID(BusinessDirectory::class, $choices);
            } catch (\Exception $e) {
                return new Response($this->get('translator')->trans('business_directory.delete.fail'), 200);
            }


            return new Response($this->get('translator')->trans('business_directory.delete.success'), 200);
        }

        return new Response('Bad Request', 400);
    }

    /**
     * Bulk activate action.
     *
     * @param Request $request
     *
     * @Route("/bulk/{isActive}", name="businessdirectory_bulk_activate_deactivate", requirements={"isActive": "1|0"})
     * @Method("DELETE")
     *
     * @return Response
     */
    public function bulkActivateAction(Request $request, $isActive, ServiceManagerInterface $sem)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            $choices = $request->request->get('data');
            $token = $request->request->get('token');

            if (!$this->isCsrfTokenValid('multiselect', $token)) {
                throw new AccessDeniedException('The CSRF token is invalid.');
            }

            $sem->enabledAll(BusinessDirectory::class, $choices, $isActive);

            if ($isActive) {
                return new Response($this->get('translator')->trans('business_directory.activate.success'), 200);
            } else {
                return new Response($this->get('translator')->trans('business_directory.deactivate.success'), 200);
            }
        }

        return new Response('Bad Request', 500);
    }
}
