<?php

namespace ServiceBundle\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;

use ServiceBundle\Datatables\Administration\AlertDatatable;
use ServiceBundle\Entity\Administration\Alert;
use ServiceBundle\Services\ServiceManagerInterface;
use ServiceBundle\Form\Administration\AlertType;

/**
 * Alert controller.
 *
 * @Route("alert")
 */
class AlertController extends Controller
{
    /**
     * Lists all grade entities.
     *
     * @Route("/", name="alert_index")
     * @Template("Administration/alert/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
        /** @var DatatableInterface $datatable */
        $alertDatatable = $this->get('sg_datatables.factory')->create(AlertDatatable::class);
        $alertDatatable->buildDatatable();
        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($alertDatatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            $datatableQueryBuilder->buildQuery();

            return $responseService->getResponse();
        }

        return array('alerts' => $alertDatatable);
    }

    /**
     * Creates a new alert entity.
     *
     * @Route("/new", name="alert_new")
     * @Method({"GET", "POST"})
     * @Template("Administration/alert/new.html.twig")
     */
    public function newAction(Request $request, ServiceManagerInterface $sem)
    {
        $alert = new Alert();
        $form = $this->createForm(AlertType::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sem->insert($alert);
            $this->addFlash('msg_success', $this->get('translator')->trans('alert.new.success'));

            return $this->redirectToRoute('alert_index');
        }

        return array(
            'alert' => $alert,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing alert entity.
     *
     * @Route("/{id}/edit", name="alert_edit")
     * @Method({"GET", "POST"})
     * @Template("Administration/alert/edit.html.twig")
     */
    public function editAction(Request $request, Alert $alert, ServiceManagerInterface $sem)
    {
        $editForm = $this->createForm(AlertType::class, $alert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sem->insert($alert);
            $this->addFlash('msg_success', $this->get('translator')->trans('alert.edit.success'));
            return $this->redirectToRoute('alert_index');
        }

        return array(
            'alert' => $alert,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/show/{id}", name="alert_show")
     * @Method("GET")
     * @Template("Administration/alert/show.html.twig")
     */
    public function showAction(Alert $alert)
    {
        return array(
            'alert' => $alert
        );
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/show_alert_header", name="alert_user_header_show")
     * @Method("GET")
     * @Template("Administration/alert/user_header.html.twig")
     */
    public function showuserAlertsAction(EntityManagerInterface $em)
    {
        $alerts = $em->getRepository(Alert::class)->findByUserLimit($this->getUser(), 5);

        return array(
            'alerts' => $alerts
        );
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/user", name="alert_user_show")
     * @Method("GET")
     * @Template("Administration/alert/user.html.twig")
     */
    public function showByUserAction(Request $request, PaginatorInterface $pagination, EntityManagerInterface $em)
    {
        $alerts = $pagination->paginate(
          $em->getRepository(Alert::class)->findByUser($this->getUser()), /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          12/*limit per page*/
        );

        return array(
            'alerts' => $alerts
        );
    }

    /**
     * Bulk delete action.
     *
     * @param Request $request
     *
     * @Route("/bulk/delete", name="alert_bulk_delete")
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
                $sem->deleteAllByID(Alert::class, $choices);
            } catch (\Exception $e) {
                return new Response($this->get('translator')->trans('alert.delete.fail'), 200);
            }


            return new Response($this->get('translator')->trans('alert.delete.success'), 200);
        }

        return new Response('Bad Request', 400);
    }
}
