<?php
/**
 * This file is part of the TripleI.bus
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\bus;

class Calculator
{
    /**
     * @var PriceList
     */
    private $price_list;

    /**
     * @param PriceList $price_list
     */
    public function __construct(PriceList $price_list)
    {
        $this->price_list = $price_list;
    }

    /**
     * @param Group $group
     * @param Section $section
     * @return Money
     */
    public function calculate(Group $group, Section $section)
    {
        $price_list = $this->price_list;

        $adult_count = $group->countAdult();

        //todo: 名前変更とconstで登録する
        $person_free_rate = 2;

        $rate = new Rate($person_free_rate);

        $free_infant_count = $adult_count->multiplication($rate);
        $infants = $group->getInfant();

        $free_normal_infant_count = $infants->countNormal();
        $free_welfare_infant_count = $infants->countWelfare();
        if (! $free_infant_count->isLarge($infants->count())) {

            if ($free_infant_count->isLarge($free_normal_infant_count)) {
                $infant_free_count = $free_infant_count->subtraction($free_normal_infant_count);
                if (! $infant_free_count->isLarge($free_welfare_infant_count)) {
                    $free_welfare_infant_count = $infant_free_count;
                }

            } else {
                $free_normal_infant_count = $free_infant_count;
                $free_welfare_infant_count = new Count(0);

            }
        }

        $result = new Money(0);
        foreach ($group->toArray() as $person) {

            if ($person instanceof I && $person->getType() instanceof N  && ! $free_normal_infant_count->isZero()) {
                $free_normal_infant_count = $free_normal_infant_count->down();
                continue;
            }
            if ($person instanceof I && $person->getType() instanceof W  && ! $free_welfare_infant_count->isZero()) {
                $free_welfare_infant_count = $free_welfare_infant_count->down();
                continue;
            }


            $person_rate = $price_list->findPriceListPart($person)->getRate();
            $type_rate = $price_list->findPriceListPart($person->getType())->getRate();

            $money = $section->convertToMoney();
            $money = $money->multiplicationOfRate($person_rate);
            $money = $money->roundUp(-1);
            $money = $money->multiplicationOfRate($type_rate);
            $money = $money->roundUp(-1);

            $result = $result->add($money);
        }

        return $result;
    }

}

