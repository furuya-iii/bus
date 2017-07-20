<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class Count
{
    /**
     * @var int
     */
    private $int;

    /**
     * @param int $int
     */
    public function __construct($int)
    {
        $this->int = $int;
    }

    /**
     * @return int
     */
    public function convertToInt()
    {
        return $this->int;
    }

    /**
     * @param Rate $rate
     * @return Count
     */
    public function multiplication(Rate $rate)
    {
        return new Count($this->int * $rate->convertToInt());
    }

    /**
     * @return Count
     */
    public function down()
    {
        return new Count($this->int - 1);
    }

    /**
     * @param Count $count
     * @return Count
     */
    public function subtraction(Count $count)
    {
        return new Count($this->int - $count->convertToInt());
    }

    /**
     * @return bool
     */
    public function isZero()
    {
        return $this->int === 0;
    }

    public function isLarge(Count $count)
    {
        return $this->int >= $count->convertToInt();
    }

}

