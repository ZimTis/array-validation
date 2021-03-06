<?php

namespace zimtis\arrayvalidation\validations;

/**
 * Responsable for validating one key schema
 *
 * @author ZimTis
 *
 * @since 0.0.6 added
 * @since 0.0.7 add getFullName method
 * @since 0.0.9 add support for callable filter
 */
abstract class Validation
{

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var Validation
     */
    private $parent;

    /**
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public abstract function validate($value);

    /**
     *
     * @param string $name
     * @return \zimtis\arrayvalidation\validations\Validation
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * returns the fully qualified name of this validation.
     * Separated by :
     *
     * @return string
     */
    public function getFullName()
    {
        // TODO make it better
        if (is_null($this->parent)) {
            return $this->getName();
        }

        return (!is_null($this->parent->getFullName()) ? ($this->parent->getFullName() . ':') : '') . $this->getName();
    }

    public function setParent(Validation $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * This method returns a keyalidation(leaf element) with a given name.
     * Seperate Parent and child names with ':' (root:root:root:leaf)
     *
     * @parem string route
     *
     * @return NULL|KeyValidation
     */
    public function getKeyValidationByName($route)
    {
        if (!is_string($route)) {
            throw new \Exception(sprintf('route must be a string, %s given', gettype($route)));
        }
    }
}