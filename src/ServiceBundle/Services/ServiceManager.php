<?php

/*
 * This file is part of the ServiceBundle package.
 *
 * (c) Service <https://gitlab.com/Sferi/service.git>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ServiceBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use ServiceBundle\Services\ServiceManagerInterface;

/**
 * Abstract Service Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Rami Sfari <rami2sfari@gmail.com>
 */

class ServiceManager implements ServiceManagerInterface
{
    /**
    * @var Doctrine\ORM\EntityManagerInterface
    */
    private $_em;

    /**
    * @var Knp\Component\Pager\PaginatorInterface
    */
    private $_pagination;

    /**
    * @param Doctrine\ORM\EntityManagerInterface $em
    * @param Knp\Component\Pager\PaginatorInterface $pagination
    */
    public function __construct(EntityManagerInterface $em, PaginatorInterface $pagination)
    {
        $this->_em = $em;
        $this->_pagination = $pagination;
    }

    /**
     * {@inheritdoc}
     */
    public function insert($object)
    {
        $this->_em->persist($object);
        $this->_em->flush($object);
    }

    /**
     * {@inheritdoc}
     */
    public function update($object)
    {
        $this->_em->flush($object);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($object)
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAllByID($className, $choices = array())
    {
        $repository = $this->_em->getRepository($className);
        foreach ($choices as $choice) {
            $object = $repository->find($choice);

            try {
                if (is_object($object)) {
                    $this->_em->remove($object);
                }
            } catch (Exception $e) {
                throw new Exception("Error this Entity has child ", 1);
            }
        }
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function enabledAll($className, $choices = array(), $boolean)
    {
        $repository = $this->_em->getRepository($className);
        foreach ($choices as $choice) {
            $object = $repository->find($choice);
            if (is_object($object)) {
                $object->setEnabled($boolean);
            }
        }
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function AddUserHobbies($className, $choices = array(), $user)
    {
        $repository = $this->_em->getRepository($className);
        foreach ($choices as $choice) {
            $object = $repository->find($choice);
            if (is_object($object)) {
                $object->addUser($user);
            }
        }
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function updateUserProfileColor($condidate, $choices)
    {
        if (key_exists('leftColor', $choices) && !empty($choices['leftColor'])) {
            $condidate->setLeftColor($choices['leftColor']);
        }
        if (key_exists('rightColor', $choices) && !empty($choices['rightColor'])) {
            $condidate->setRightColor($choices['rightColor']);
        }
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserDashbord()
    {
      $this->_em->getRepository(User::class)->countAll();
      $this->_em->getRepository(User::class)->countAll();
      $this->_em->getRepository(User::class)->countAll();

      
    }
}
