<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class bus
{

    /**
     * @var null | Group
     */
    private $group = null;

    /**
     * @var null | Section
     */
    private $section = null;

    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * @param Calculator $calculator
     */
    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param Group $group
     * @param $section
     */
    public function getOn(Group $group,Section $section)
    {
        $this->group = $group;
        $this->section = $section;
    }

    /**
     * @return Money
     */
    public function billing()
    {
        if (is_null($this->group)) {
            return new Money(0);
        }

        $money = $this->calculator->calculate($this->group, $this->section);

        return $money;
    }

}
