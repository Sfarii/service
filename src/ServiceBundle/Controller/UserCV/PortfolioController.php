<?php

namespace ServiceBundle\Controller\UserCV;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ServiceBundle\Entity\UserCV\Portfolio;
use ServiceBundle\Form\UserCV\PortfolioType;

/**
 * Portfolio controller.
 *
 * @Route("usercv_portfolio")
 * @Security("has_role('ROLE_USER')")
 */
class PortfolioController extends Controller
{
    /**
     * Lists all portfolio entities.
     *
     * @Route("/", name="portfolio_index")
     * @Method("GET")
     * @Template("UserCV/portfolio/index.html.twig")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $portfolios = $em->getRepository(Portfolio::class)->findBy(array('user' => $this->getUser()));
        return array('portfolios' => $portfolios);
    }

    /**
     * Creates a new portfolio entity.
     *
     * @Route("/new", name="portfolio_new")
     * @Method({"GET", "POST"})
     * @Template("UserCV/portfolio/new.html.twig")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
        $portfolio = new Portfolio();
        $form = $this->createForm(PortfolioType::class, $portfolio, [ 'user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($portfolio);
            $em->flush();

            return new JsonResponse(array('msg' => $this->get('translator')->trans('portfolio.new.success')), 200);
        }

        return array(
            'portfolio' => $portfolio,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing portfolio entity.
     *
     * @Route("/{id}/edit", name="portfolio_edit")
     * @Method({"GET", "POST"})
     * @Template("UserCV/portfolio/edit.html.twig")
     */
    public function editAction(Request $request, Portfolio $portfolio, EntityManagerInterface $em)
    {
        $editForm = $this->createForm(PortfolioType::class, $portfolio, [ 'user' => $this->getUser()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return new JsonResponse(array('msg' => $this->get('translator')->trans('portfolio.edit.success')), 200);
        }

        return array(
            'portfolio' => $portfolio,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a portfolio entity.
     *
     * @Route("delete/{id}", name="portfolio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(EntityManagerInterface $em, Portfolio $portfolio)
    {
      try {
        $em->remove($portfolio);
        $em->flush();
        return new JsonResponse(array('msg' => $this->get('translator')->trans('portfolio.delete.success')), 200);
      } catch (\Exception $e) {
        return new JsonResponse(array('msg' => $this->get('translator')->trans('portfolio.delete.fail')), 200);
      }
    }
}
