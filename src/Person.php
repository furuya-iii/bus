<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

abstract class Person
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @param Type $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }

}

