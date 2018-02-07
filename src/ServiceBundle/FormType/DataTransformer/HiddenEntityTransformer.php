<?php

namespace ServiceBundle\FormType\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class HiddenEntityTransformer
 */
class HiddenEntityTransformer implements DataTransformerInterface
{
    /**
    * @var string
    */
    protected $_class;

    /**
    * @var string
    */
    protected $_property;

    /**
    * @var Doctrine\ORM\EntityManagerInterface
    */
    protected $_em;

    /**
     * @param ObjectManager $objectManager
     * @param string          $class
     * @param string          $property
     */
    public function __construct(EntityManagerInterface $objectManager, $class = '' , $property = "id")
    {
        $this->_class = $class;
        $this->_property = $property;
        $this->_em = $objectManager;
    }

    /**
     * @param mixed $entity
     *
     * @return mixed|null
     * @throws TransformationFailedException if object ($entity) is not found.
     * @throws InvalidConfigurationException if There is no getter for property.
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return null;
        }

        if (!$entity instanceof $this->_class) {
            throw new TransformationFailedException(sprintf('Object must be instance of %s, instance of %s has given.', $this->class, get_class($entity)));
        }
        $methodName = 'get' . ucfirst($this->_property);
        if (!method_exists($entity, $methodName)) {
            throw new InvalidConfigurationException(sprintf('There is no getter for property "%s" in class "%s".', $this->property, $this->class));
        }
        return $entity->{$methodName}();
    }

     /**
     * Transforms a string (number) to an object.
     *
     * @param  string $identifier
     * @return mixed|null|object
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($identifier)
    {
        if (!$identifier) {
            return null;
        }
        $entity = $this->_em->getRepository($this->_class)->find($identifier);

        if (null === $entity) {
            throw new TransformationFailedException(sprintf('Can\'t find entity of class "%s" with property "%s" = "%s".', $this->_class, $this->_property, $identifier));
        }
        return $entity;
    }
}
