<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class Rate
{
    /**
     * @var int
     */
    private $rate;

    /**
     * @param int $rate 通常料金の倍率
     */
    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return int
     */
    public function convertToInt()
    {
        return $this->rate;
    }

}

