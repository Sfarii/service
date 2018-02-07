<?php

namespace ServiceBundle\Controller\Search;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Form\Search\SearchType;
use Knp\Component\Pager\PaginatorInterface;

use ServiceBundle\Entity\BusinessDirectory\BusinessDirectory;
use Doctrine\ORM\EntityManagerInterface;
use ServiceBundle\Entity\UserManagment\User as User;

use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class SearchController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("Search/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return array();
    }

    /**
     * @Route("/search", name="search_result")
     * @Method("GET")
     * @Template("Search/result.html.twig")
     */
    public function searchAction(Request $request, EntityManagerInterface $em, PaginatorInterface $pagination)
    {
        $keyword = $request->get('search' , null);
        $token = $request->get('token' , null);

        if (!is_null($token) && !$this->isCsrfTokenValid('search', $token)) {
            throw new AccessDeniedException('The CSRF token is invalid.');
        }

        $users = $pagination->paginate(
          $em->getRepository(User::class)->findByKeyword($keyword), /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          12/*limit per page*/
        );

        $businessDirectorys = $pagination->paginate(
          $em->getRepository(BusinessDirectory::class)->findByKeyword($keyword), /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          12/*limit per page*/
        );

        // parameters to template
        return array(
          'users' => $users,
          'businessDirectorys' => $businessDirectorys,
          'keyword' => $keyword
        );
    }
}
