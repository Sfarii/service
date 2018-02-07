<?php

namespace ServiceBundle\Controller\Dashbord;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ServiceBundle\Entity\UserManagment\User as User;
use ServiceBundle\Entity\Administration\ContactUS;
use ServiceBundle\Entity\BusinessDirectory\BusinessDirectory;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class DashbordController extends Controller
{
    /**
     * @Route("/dashbord", name="dashboard_index")
     * @Template("Dashbord/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        return array(
          'countUsers' => $em->getRepository(User::class)->countAll(),
          'countBusinessDirectorys' => $em->getRepository(BusinessDirectory::class)->countAll(),
          'countContacts' => $em->getRepository(ContactUS::class)->countAll(),
          'users' => $em->getRepository(User::class)->findAllByMonth(),
          'businessDirectorys' => $em->getRepository(BusinessDirectory::class)->findAllByMonth()
        );
    }
}
