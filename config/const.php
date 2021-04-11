<?php

return [
    // usersで使う定数
    'Users' => [
        'FINAL_EDUCATION_GRAD_SCHOOL' => 0,
        'FINAL_EDUCATION_UNIVERSITY' => 1,
        'FINAL_EDUCATION_JUNIOR_COLLEGE' => 2,
        'FINAL_EDUCATION_TRADE_SCHOOL' => 3,
        'FINAL_EDUCATION_HIGH_SCHOOL' => 4,
        'FINAL_EDUCATION_JUNIOR_HIGH_SCHOOL' => 5,
        'FINAL_EDUCATION_LIST' => [
            0 => '大学院卒',
            1 => '大学卒',
            2 => '短大卒',
            3 => '専門学校卒',
            4 => '高校卒',
            5 => '中学卒',
        ],
    ],
    'Entries' => [
        'STATUS_NEW' => 0,
        'STATUS_OK' => 1,
        'STATUS_NG' => 2,
        'STATUS_LIST' => [
            0 => '新規',
            1 => '採用',
            2 => '不採用',
        ],
        'STATUS_BADGE_LIST' => [
            0 => 'badge-primary',
            1 => 'badge-success',
            2 => 'badge-danger',
        ],
    ],
];