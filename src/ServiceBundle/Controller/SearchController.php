<?php

namespace ServiceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ServiceBundle\Form\SearchType;
use ServiceBundle\Services\ServiceManager;

class SearchController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("search/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SearchType::class, null, array('method' => 'GET'))->handleRequest($request);
        // parameters to template
        return array('form' => $form->createView());
    }

    /**
     * @Route("/search", name="search_result")
     * @Template("search/result.html.twig")
     * @Method("GET")
     */
    public function searchAction(Request $request, ServiceManager $serviceManager)
    {
        $form = $this->createForm(SearchType::class, null, array('method' => 'GET'))->handleRequest($request);

        // parameters to template
        return array('form' => $form->createView());
    }
}
