<?php

namespace ServiceBundle\Controller\UserManagment;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use ServiceBundle\Services\ServiceManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ServiceBundle\Entity\UserManagment\User;
use ServiceBundle\Form\UserCV\UserType;

use ServiceBundle\Datatables\UserCV\UserDatatable;

/**
 * User controller.
 *
 * @Route("usercv_user")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends Controller
{

    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     * @Template("User/candidate/index.html.twig")
     */
    public function indexAction(Request $request, EntityManagerInterface $em)
    {
        $isAjax = $request->isXmlHttpRequest();
        /** @var DatatableInterface $datatable */
        $userDatatable = $this->get('sg_datatables.factory')->create(UserDatatable::class);
        $userDatatable->buildDatatable();
        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response')->setDatatable($userDatatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            /** @var QueryBuilder $qb */
            $qb = $datatableQueryBuilder->getQb();
            $qb->andWhere('user.isCondidate = 1');
            return $responseService->getResponse();
        }

        return array('users' => $userDatatable);
    }

    /**
     * Bulk activate action.
     *
     * @param Request $request
     *
     * @Route("/bulk/{isActive}", name="user_bulk_activate_deactivate", requirements={"isActive": "1|0"})
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

            $sem->enabledAll(User::class, $choices, $isActive);

            if ($isActive) {
                return new Response($this->get('translator')->trans('user.activate.success'), 200);
            } else {
                return new Response($this->get('translator')->trans('user.deactivate.success'), 200);
            }
        }

        return new Response('Bad Request', 500);
    }
}
