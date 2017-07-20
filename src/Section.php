<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class Section
{
    /**
     * @var int
     */
    private $fare;

    /**
     * @param int $fare
     */
    public function __construct($fare)
    {
        $this->fare = $fare;
    }

    /**
     * @return Money
     */
    public function convertToMoney()
    {
        return new Money($this->fare);
    }

}

