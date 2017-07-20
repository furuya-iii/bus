<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class Money
{
    /**
     * @var int
     */
    private $int;

    public function __construct($int)
    {
        $this->int = $int;
    }

    /**
     * @return int
     */
    public function convertToInt()
    {
        return (int)$this->int;
    }

    /**
     * @param Rate $rate
     * @return Money
     */
    public function multiplicationOfRate(Rate $rate)
    {
        return new Money($this->int * $rate->convertToInt());
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function add(Money $money)
    {
        return new Money($this->int + $money->convertToInt());
    }

    /**
     * @param int $precision
     * @return Money
     */
    public function roundUp($precision = 0)
    {
        return new Money(round($this->int, $precision));
    }
}

