<?php

namespace TripleI\bus;

class busTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var bus
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();

        $price_list_parts = [
            new PriceListPart('TripleI\bus\A', new Rate(1)),
            new PriceListPart('TripleI\bus\C', new Rate(0.5)),
            new PriceListPart('TripleI\bus\I', new Rate(0.5)),

            new PriceListPart('TripleI\bus\N', new Rate(1)),
            new PriceListPart('TripleI\bus\P', new Rate(0)),
            new PriceListPart('TripleI\bus\W', new Rate(0.5)),

        ];
        $calculator = new Calculator(new PriceList($price_list_parts));
        $this->skeleton = new bus($calculator);
    }

    public function testNew()
    {

        $samples = [
            '210:Cn,In,Iw,Ap,Iw' => 170,
            '220:Cp,In'	=> 110,
            '230:Cw,In,Iw' =>	240,
            '240:In,An,In'=>	240,
            '250:In,In,Aw,In'=>	260,
            '260:In,In,In,In,Ap'=>	260,
            '270:In,An,In,In,Ip'=>	410,
            '280:Aw,In,Iw,In'=>	210,
            '200:An'	=>200,
            '210:Iw'=>	60,
            '220:Ap'	=>0,
            '230:Cp'	=>0,
            '240:Cw'	=>60,
            '250:In'	=>130,
            '260:Cn'	=>130,
            '270:Ip'	=>0,
            '280:Aw'	=>140,
            '1480:In,An,In,In,In,Iw,Cp,Cw,In,Aw,In,In,Iw,Cn,Aw,Iw'	=>5920
        ];



        foreach ($samples as $input => $value) {
            $bus = $this->skeleton;

            $input = explode(':', $input);
            $section = $input[0];

            $persons = [];
            foreach (explode(',', $input[1]) as $part) {
                $person = substr($part, 0,1);
                $type = substr($part, 1, 2);

                $person_class_name = '\TripleI\bus\\' . $person;
                $type_class_name = '\TripleI\bus\\' . $type;
                $person = new $person_class_name(new $type_class_name);
                $persons[] = $person;
            }

            $section = new Section($section);
            $group = new Group($persons);
            $bus->getOn($group, $section);
            $result = $bus->billing();

            var_dump($value === $result->convertToInt());
        }

    }

}
