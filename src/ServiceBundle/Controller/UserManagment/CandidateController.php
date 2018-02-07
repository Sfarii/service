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
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

use ServiceBundle\Entity\UserManagment\User;
use ServiceBundle\Form\User\RegistrationType;
use ServiceBundle\Form\User\UserFormType;

/**
 * User controller.
 *
 * @Route("candidate")
 */
class CandidateController extends Controller
{

    /**
     * @Route("/pdf", name="cv_pdf")
     * @Method("GET")
     * Template("User/candidate/print.html.twig")
     */
    public function pdfAction(Request $request)
    {
      $html = $this->renderView('User/candidate/print.html.twig', array(
        'user'  => $this->getUser()
      ));
      //  $pdfGenerator = $this->get('spraed.pdf.generator');
       //
      //  return new Response($pdfGenerator->generatePDF($html),
      //                  200,
      //                  array(
      //                      'Content-Type' => 'application/pdf',
      //                      'Content-Disposition' => 'inline; filename="out.pdf"'
      //                  )
      //  );
      //   // // return array(
      //   // //   'user'  => $this->getUser()
      //   // // );
      //   // $html = $this->renderView('User/candidate/print.html.twig', array(
      //   //   'user'  => $this->getUser()
      //   // ));

        return new Response(
          $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array(
                'enable-javascript' => false,
                'page-size' => "A2",
                'encoding' => 'utf-8',
                'enable-external-links' => true,
                'enable-internal-links' => true
            )
          ),
          200,
          array(
          'Content-Type' => 'application/pdf',
          'Content-Disposition' => 'attachment; filename='.$this->getUser()
          )
        );
    }

    /**
     * @Route("/img", name="cv_img")
     * @Method("GET")
     * @Template("User/candidate/print.html.twig")
     */
    public function imageAction(Request $request)
    {
        return array(
          'user'  => $this->getUser()
        );
      //   $html = $this->renderView('User/candidate/print.html.twig', array(
      //     'user'  => $this->getUser()
      //   ));
      //
      //   return new JpegResponse(
      //     $this->get('knp_snappy.image')->getOutputFromHtml($html),
      //     'cv.jpg'
      // );
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/show/{id}", name="user_show")
     * @Method("GET")
     * @Template("User/candidate/show.html.twig")
     */
    public function showAction(User $user)
    {
        return array(
            'user' => $user
        );
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/cv/{id}", name="condidate_cv_edit")
     * @Method("GET")
     * @Template("User/candidate/edit.html.twig")
     */
    public function editAction(User $user)
    {
        return array(
            'user' => $user
        );
    }

    /**
     * Bulk update profile color action.
     *
     * @param Request $request
     *
     * @Route("/bulk/{id}", name="user_bulk_update_profile_color")
     * @Method("POST")
     *
     * @return Response
     */
    public function bulkUpdateProfileColorAction(Request $request, User $condidate, ServiceManagerInterface $sem)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            $choices = ['leftColor' => $request->request->get('leftColor'), 'rightColor' => $request->request->get('rightColor')];
            $token = $request->request->get('token');

            if (!$this->isCsrfTokenValid('multiselect', $token)) {
                throw new AccessDeniedException('The CSRF token is invalid.');
            }

            $sem->updateUserProfileColor($condidate, $choices);
            return new JsonResponse(array('msg' => $this->get('translator')->trans('user.update_color.success')), 200);
        }

        return new JsonResponse('Bad Request', 500);
    }
}
