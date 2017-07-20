<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

use TripleI\bus\Exception\LogicException;

class PriceListPart
{
    /**
     * @var string
     */
    private $class_name;

    /**
     * @var Rate
     */
    private $rate;

    /**
     * @param string $class_name
     * @param Rate $rate
     */
    public function __construct($class_name, Rate $rate)
    {
        if (class_exists($class_name) === false) {
            throw new LogicException('invalid class name');
        }

        $this->class_name = $class_name;
        $this->rate = $rate;
    }

    /**
     * @param object $object
     * @return bool
     */
    public function isTarget($object)
    {
        if (! is_object($object)) {
            throw new LogicException('not a object');
        }

        $class_name = $this->class_name;
        return $object instanceof $class_name;
    }

    /**
     * @return Rate
     */
    public function getRate()
    {
        return $this->rate;
    }

}

