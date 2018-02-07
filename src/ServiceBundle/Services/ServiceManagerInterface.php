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

/**
 * Interface to be implemented by service managers. This adds an additional level
 * of abstraction between the application, and the actual repository.
 *
 * @author Sfari Rami <rami2sfari@gmail.com>
 */
interface ServiceManagerInterface
{

  /**
  * delete multiple entity from the database
  *
  * @param Object $object
  * @param array $choices
  * @throws Exception
  */
  public function deleteAllByID($className, $choices = array());

  /**
  * delete one entity from the database
  *
  * @param Object $object
  * @return void
  */
  public function delete($object);

  /**
  * update entity in the database
  *
  * @param Object $object
  * @return void
  */
  public function update($object);

  /**
  * insert entity in the database
  *
  * @param Object $object
  * @return void
  */
  public function insert($object);

  /**
  * update profile color action.
  *
  * @param Object $user
  * @param array $choices
  * @return void
  */
  public function updateUserProfileColor($condidate, $choices);

}
