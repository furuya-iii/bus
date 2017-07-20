<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class Group
{
    /**
     * @var Person[]
     */
    private $persons;

    /**
     * @param Person[] $persons
     */
    public function __construct($persons)
    {
        $this->persons = $persons;
    }

    /**
     * @return Person[]
     */
    public function toArray()
    {
        return $this->persons;
    }

    /**
     * @return Count
     */
    public function countAdult()
    {
        $count = 0;
        foreach ($this->persons as $person) {
            if ($person instanceof A) {
                $count++;
            }
        }

        return new Count($count);
    }

    /**
     * @return Group
     */
    public function getInfant()
    {
        $results = [];
        foreach ($this->persons as $person) {
            if ($person instanceof I) {
                $results[] = $person;
            }
        }

        return new Group($results);
    }

    public function countNormal()
    {
        $count = 0;
        foreach ($this->persons as $person) {
            $type = $person->getType();
            if ($type instanceof N) {
                $count++;
            }
        }

        return new Count($count);

    }

    public function countWelfare()
    {
        $count = 0;
        foreach ($this->persons as $person) {
            $type = $person->getType();
            if ($type instanceof W) {
                $count++;
            }
        }

        return new Count($count);
    }

    /**
     * @return Count
     */
    public function count()
    {
        return new Count(count($this->persons));
    }
}

