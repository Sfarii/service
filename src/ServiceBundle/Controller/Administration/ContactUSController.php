<?php

namespace ServiceBundle\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use ServiceBundle\Services\ServiceManagerInterface;
use Symfony\Component\HttpFoundation\Response;

use ServiceBundle\Entity\Administration\ContactUS;
use ServiceBundle\Form\Administration\ContactUSType;
use ServiceBundle\Datatables\Administration\ContactUSDatatable;

/**
 * ContactUS controller.
 *
 * @Route("contactus")
 */
class ContactUSController extends Controller
{
    /**
     * Lists all contactUS entities.
     *
     * @Route("/", name="contactus_index")
     * @Method("GET")
     * @Template("Administration/contactus/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
        /** @var DatatableInterface $datatable */
        $contactDatatable = $this->get('sg_datatables.factory')->create(ContactUSDatatable::class);
        $contactDatatable->buildDatatable();
        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($contactDatatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            $datatableQueryBuilder->buildQuery();

            return $responseService->getResponse();
        }

        return array('contacts' => $contactDatatable);
    }

    /**
     * Creates a new contactUS entity.
     *
     * @Route("/new", name="contactus_new")
     * @Method({"GET", "POST"})
     * @Template("Administration/contactus/new.html.twig")
     */
    public function newAction(Request $request, ServiceManagerInterface $sem)
    {
        $contactUS = new ContactUS();
        $form = $this->createForm(ContactUSType::class, $contactUS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sem->insert($contactUS);
            $this->addFlash('msg_success', $this->get('translator')->trans('contactus.new.success'));
            return $this->redirectToRoute('homepage');
        }

        return array(
            'contactUS' => $contactUS,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a contactUS entity.
     *
     * @Route("/{id}", name="contactus_show")
     * @Method("GET")
     * @Template("Administration/contactus/show.html.twig")
     */
    public function showAction(ContactUS $contactUS)
    {
        return array(
            'contactUS' => $contactUS
        );
    }

    /**
     * Deletes a contactUS entity.
     *
     * @Route("/delete", name="contactus_bulk_delete")
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
                $sem->deleteAllByID(ContactUS::class, $choices);
            } catch (\Exception $e) {
                return new Response($this->get('translator')->trans('contactus.delete.fail'), 200);
            }


            return new Response($this->get('translator')->trans('contactus.delete.success'), 200);
        }

        return new Response('Bad Request', 400);
    }
}
