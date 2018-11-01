<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/2/18
 * Time: 6:32 PM
 */

namespace App\Constants;


abstract class DefaultData
{

    const PLANTING_DATES = [

        [
            'menu' => [
                "value" => "-3",
                "type" => ModelConstants::PLANTING_DATES
            ],
            'translation' => [
                'english' => '2-4 weeks ago',
                'yoruba' => 'Ose meji - merin seyin',
                'ibo' => 'Out izu uka-abuo galaga',
            ]
        ],
        [
            'menu' => [
                "value" => "-1",
                "type" => ModelConstants::PLANTING_DATES
            ],
            'translation' => [
                'english' => '1-2 weeks ago',
                'yoruba' => 'Ose kan - meji seyin',
                'ibo' => 'Izu ukaa',
            ]
        ],
        [
            'menu' => [
                "value" => "0",
                "type" => ModelConstants::PLANTING_DATES
            ],
            'translation' => [
                'english' => 'This week',
                'yoruba' => 'Ose yi',
                'ibo' => 'Otu izu uka-abuo',
            ]
        ],
        [
            'menu' => [
                "value" => "1",
                "type" => ModelConstants::PLANTING_DATES
            ],
            'translation' => [
                'english' => 'In 1-2 weeks',
                'yoruba' => 'Ose kan - meji to’nbo',
                'ibo' => 'Izu uka abuo-anu',
            ]
        ],
        [
            'menu' => [
                "value" => "2",
                "type" => ModelConstants::PLANTING_DATES
            ],
            'translation' => [
                'english' => 'In 2-4 weeks',
                'yoruba' => 'Ose meji - merin to’nbo',
                'ibo' => 'Nahachi',
            ]
        ],

    ];

    const FIELD_AREAS = [
        [
            'menu' => [
                "value" => "0.25",
                "type" => ModelConstants::FIELD_AREAS
            ],
            'translation' => [
                'english' => 'About 0.25 acre (0.1 ha)',
                'yoruba' => 'Bi ilarin eeka (0.1 ha)',
                'ibo' => 'O la ka otu uzo n’ime uzo anu acre (0.1 ha)',
            ]
        ],
        [
            'menu' => [
                "value" => "0.5",
                "type" => ModelConstants::FIELD_AREAS
            ],
            'translation' => [
                'english' => 'About 0.5 acre (0.2 ha)',
                'yoruba' => 'Bi ilaji eeka (0.2 ha)',
                'ibo' => 'O la ka ukara acre (0.2 ha)',
            ]
        ],
        [
            'menu' => [
                "value" => "1",
                "type" => ModelConstants::FIELD_AREAS
            ],
            'translation' => [
                'english' => 'About 1 acre (0.4 ha)',
                'yoruba' => 'Bi eeka kan (0.4 ha)',
                'ibo' => 'O la ka otu acre (0.4 ha)',
            ]
        ],
        [
            'menu' => [
                "value" => "2.5",
                "type" => ModelConstants::FIELD_AREAS
            ],
            'translation' => [
                'english' => 'About 2.5 acre (1 ha)',
                'yoruba' => 'Bi eeka meji ati abo (1 ha)',
                'ibo' => 'O la ka abuo na ukara acre (1 ha)',
            ]
        ]
    ];


    const  HARVESTING_QUANTITY = [
        [
            'menu' => [
                "value" => "37",
                "type" => ModelConstants::QUANTITY
            ],
            'translation' => [
                'english' => 'Less than 1 tonne',
                'yoruba' => 'O kere si tonne kan',
                'ibo' => 'O naghi eru otu ntu tonne',
            ]
        ],
        [
            'menu' => [
                "value" => "46",
                "type" => ModelConstants::QUANTITY
            ],
            'translation' => [
                'english' => '1 – 2 tonnes',
                'yoruba' => 'Bi tonne kan si tonne meji',
                'ibo' => 'Otu ntu-ntu abuo tonne ',
            ]
        ],
        [
            'menu' => [
                "value" => "52",
                "type" => ModelConstants::QUANTITY
            ],
            'translation' => [
                'english' => '2 – 3 tonnes',
                'yoruba' => 'Bi tonne meji si tonne meta',
                'ibo' => 'Ntu abuo-ntu ato tonne',
            ]
        ],
        [
            'menu' => [
                "value" => "59",
                "type" => ModelConstants::QUANTITY
            ],
            'translation' => [
                'english' => '3 – 4 tonnes',
                'yoruba' => 'Bi tonne meta si tonne merin',
                'ibo' => 'Ntu ato-ntu anu tonne',
            ]
        ],
        [
            'menu' => [
                "value" => "67",
                "type" => ModelConstants::QUANTITY
            ],
            'translation' => [
                'english' => 'More than 4 tonnes',
                'yoruba' => 'O ju tonne merin lo',
                'ibo' => 'O na kari ntu anu tonne',
            ]
        ],
    ];


    const FERTILIZERS = [
        ["name" => "Urea", "availability" => "*"],
        ["name" => "NPK15:15:15", "availability" => "NG"],
        ["name" => "MOP", "availability" => "*"]
        /*["name" => "NPK17:17:17","availability"=>"*"],
        ["name" => "NPK20:10:10","availability"=>"NG"],
        ["name" => "TSP","availability"=>"*"],
        ["name" => "DAP","availability"=>"*"],
        ["name" => "SSP","availability"=>"NG"],
        ["name" => "CAN","availability"=>"*"],
        ["name" => "Nafaka plus","availability"=>"*"],*/
    ];

    const PRICE_RANGES = [
        ["min" => "6000", "max" => "10000", "value" => "0.5"],
        ["min" => "10000", "max" => "14000", "value" => "0.7"],
        ["min" => "14000", "max" => "18000", "value" => "0.9"],
        ["min" => "18000", "max" => "22000", "value" => "1.1"],
        ["min" => "22000", "max" => "26000", "value" => "1.1"],
        ["min" => "26000", "max" => "30000", "value" => "1.1"]
    ];

    const UNITS_OF_SALE = [
        ["display" => "tonne", "value" => "1000"],
        ["display" => "kg", "value" => "1"],
        ["display" => "50 kg bag", "value" => "50"],
        ["display" => "100 kg bag", "value" => "100"],

    ];

    const UNIT_PRICES = [
        ["min" => "5000", "max" => "10000", "value" => "25"],
        ["min" => "10000", "max" => "15000", "value" => "40"],
        ["min" => "15000", "max" => "20000", "value" => "75"],
        ["min" => "20000", "max" => "25000", "value" => "125"],
        ["min" => "25000", "max" => "30000", "value" => "175"],
        ["min" => "30000", "max" => "35000", "value" => "175"]
    ];


    const MAXIMAL_INVESTMENTS = [
        ["amount" => "7500", "value" => "62"],
        ["amount" => "15000", "value" => "124"],
        ["amount" => "30000", "value" => "247"],
        ["amount" => "45000", "value" => "371"],
        ["amount" => "60000", "value" => "494"]
    ];

}