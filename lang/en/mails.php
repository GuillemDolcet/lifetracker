<?php

declare(strict_types=1);

return [

    'subjects' => [
        'inspections' => 'Inspection Report',
    ],
    'advice' => 'Notice',
    'advices' => [
        'near' => 'upcoming inspections',
        'nearToExpire' => 'current inspections',
        'expired' => 'expired inspections',
    ],
    'lists' => [
        'near' => 'List of companies with upcoming inspections scheduled for the next three months',
        'nearToExpire' => 'List of companies with inspections to be carried out during this month',
        'expired' => 'List of companies with inspections scheduled for past dates',
    ],
    'tables' => [
        'empty' => [
            'near' => 'No upcoming inspections to display',
            'nearToExpire' => 'No inspections scheduled for this month',
            'expired' => 'No expired inspections',
        ],
    ],
    'inspections' => [
        'info' => 'Through this email, we inform you of the inspections that are upcoming or expired in any of the following months.',
        'types' => [
            'next' => 'Open',
            'correction' => 'Correction',
        ],
    ],
    'responsible' => 'Dear responsible person of',
];
