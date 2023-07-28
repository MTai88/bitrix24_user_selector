<?php

return [
    'ui.entity-selector' => [
        'value' => [
            'entities' => [
                [
                    'entityId' => 'user-filtered',
                    'provider' => [
                        'moduleId' => 'mtai',
                        'className' => '\\MTai\\Integration\\UI\\EntitySelector\\UserFilteredProvider'
                    ],
                ],
            ],
            'extensions' => ['socialnetwork.entity-selector'],
        ],
        'readonly' => true,
    ]
];