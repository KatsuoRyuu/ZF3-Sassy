<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KryuuCommon\Sassy;

use KryuuCommon\Sassy\Helper\HeadSass;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'view_helpers' => [
        'aliases' => [
            'headStyle' => HeadSass::class,
        ],
        'factories' => [
            HeadSass::class => InvokableFactory::class // Or use your own factory
        ]
    ],
];