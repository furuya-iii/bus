<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

use TripleI\bus\Exception\LogicException;

class PriceList
{
    /**
     * @var PriceListPart []
     */
    private $price_list_parts;

    /**
     * @param PriceListPart [] $price_list_parts
     */
    public function __construct($price_list_parts)
    {
        $this->price_list_parts = $price_list_parts;
    }

    /**
     * @param $object
     * @return PriceListPart
     */
    public function findPriceListPart($object)
    {
        if (! is_object($object)) {
            throw new LogicException('not a object');
        }

        $price_list_parts = $this->price_list_parts;
        foreach ($price_list_parts as $price_list_part) {
            if ($price_list_part->isTarget($object)) {
                return $price_list_part;
            }
        }

        throw new LogicException('not found part');
    }

}

