<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Doctrine\ORM\EntityManagerInterface;
use ServiceBundle\Services\ServiceManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;

use ServiceBundle\Entity\UserCV\Interests;

/**
 * User hobbies controller.
 *
 * @Route("hobbie")
 * @Security("has_role('ROLE_USER')")
 */
class UserHobbiesController extends Controller
{
    /**
     * Lists all hobbies entities.
     *
     * @Route("/", name="hobbies_index")
     * @Method("GET")
     * @Template("UserCV/hobbies/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
      $hobbies = $em->getRepository(Interests::class)->findByUser($this->getUser());
      return array('hobbies' => $hobbies);
    }

    /**
     * Lists all hobbies entities.
     *
     * @Route("/new", name="hobbies_new")
     * @Method("GET")
     * @Template("UserCV/hobbies/new.html.twig")
     */
    public function newAction(Request $request, EntityManagerInterface $em, PaginatorInterface $pagination)
    {
        $hobbies = $pagination->paginate(
          $em->getRepository(Interests::class)->findAllHobbies(), /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          5/*limit per page*/
        );

        return array('hobbies' => $hobbies);
    }

    /**
     * Deletes a education entity.
     *
     * @Route("/{id}", name="hobbie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(EntityManagerInterface $em, Interests $hobbie)
    {
      try {
        $hobbie->removeUser($this->getUser());
        $em->flush();
        return new JsonResponse(array('msg' => $this->get('translator')->trans('hobbie.delete.success')), 200);
      } catch (\Exception $e) {
        return new JsonResponse(array('msg' => $this->get('translator')->trans('hobbie.delete.fail')), 200);
      }
    }

    /**
     * new a hobbie entity.
     *
     * @Route("/edit", name="hobbie_bulk_new")
     * @Method("POST")
     */
    public function editAction(Request $request, ServiceManagerInterface $sem)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            $choices = $request->request->get('data');
            $token = $request->request->get('token');

            if (!$this->isCsrfTokenValid('multiselect', $token)) {
                throw new AccessDeniedException('The CSRF token is invalid.');
            }

            try {
                $sem->AddUserHobbies(Interests::class, $choices, $this->getUser());
            } catch (\Exception $e) {
                return new JsonResponse(array('msg' => $this->get('translator')->trans('hobbie.update.already_existe')), 200);
            }

            return new JsonResponse(array('msg' => $this->get('translator')->trans('hobbie.update.success')), 200);
        }
        return new JsonResponse(array('msg' => 'Bad Request'), 200);
    }
}
