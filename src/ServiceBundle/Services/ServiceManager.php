<?php

namespace ServiceBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @author Rami Sfari <rami2sfari@gmail.com>
 * @copyright Copyright (c) 2017, SMS
 */

class ServiceManager
{
    /**
    * @var EntityManager
    */
    private $_em;

    private $_pagination;

    /**
    * @param Doctrine\ORM\EntityManager $em
    */
    public function __construct(EntityManagerInterface $em, PaginatorInterface $pagination)
    {
        $this->_em = $em;
        $this->_pagination = $pagination;
    }

    /**
    * get search result
    *
    * @param String $Keyword
    */
    public function getUserSearchResult($Keyword)
    {
      $this->_pagination->getPaginator()->paginate(
        $result, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        12/*limit per page*/
      );
    }

    /**
    * @param String $Keyword
    */
    public function getBusinessDirectorySearchResult($Keyword)
    {
      $this->_pagination->getPaginator()->paginate(
        $result, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        12/*limit per page*/
      );
    }

}
