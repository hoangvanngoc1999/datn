<?php

return [
    [
        'label' => 'Dashboard',
        'route' => 'admin.index',
        'icon' => 'fa-home'
    ],
    [
        'label' => 'Category Manager',
        'route' => 'category.index',
        'icon' => 'fa-shopping-cart',
        'items' => [
            [
                'label' => 'List category',
                'route' => 'category.index',
            ],
            [
                'label' => 'Add category',
                'route' => 'category.create',
            ]
        ]
    ],
    [
        'label' => 'Product Manager',
        'route' => 'product.index',
        'icon' => 'fa-shopping-cart',
        'items' => [
            [
                'label' => 'List product',
                'route' => 'product.index',
            ],
            [
                'label' => 'Add product',
                'route' => 'product.create',
            ]
        ]
    ],
    // [
    //     'label' => 'Comment Manager',
    //     'route' => 'comment.index',
    //     'icon' => 'fa-image',
    //     'items' => [
    //         [
    //             'label' => 'List comment',
    //             'route' => 'comment.index',
    //         ]
    //     ]
    // ],
   
    [
        'label' => 'Order Manager',
        'route' => 'order.index',
        'icon' => 'fa-shopping-cart',
        'items' => [
            [
                'label' => 'List Order',
                'route' => 'order.index',
            ]
        ]
    ],
    [
        'label' => 'Guest Manager',
        'route' => 'guest.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'List account',
                'route' => 'guest.index',
            ]
        ]
    ],
    [
        'label' => 'User Manager',
        'route' => 'user.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'List user',
                'route' => 'user.index',
            ],
            [
                'label' => 'Add user',
                'route' => 'user.create',
            ]
            
        ]
    ]
]

?>