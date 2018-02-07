<?php

namespace ServiceBundle\Controller\Translate;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TranslateController extends Controller
{
    /**
     * @Route("/translate" , name="translate_index")
     * @Method("GET")
     */
    public function translatorAction(Request $request)
    {
        $lang = $request->get('lang' , "en");
        $token = $request->get('token' , null);

        if (!is_null($token) && !$this->isCsrfTokenValid('lang', $token)) {
            throw new AccessDeniedException('The CSRF token is invalid.');
        }

        if (in_array($lang, $this->getParameter('lang_supported'))) {
          $session = $request->getSession();
          $session->set('_locale', $lang);
        }

        if (!is_null($request->headers->get('referer'))){
          return $this->redirect($request->headers->get('referer'));
        }

        return $this->redirectToRoute('homepage');
    }
}
