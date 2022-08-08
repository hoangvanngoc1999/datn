<?php

return [
    [
        'label' => 'Dashboard',
        'route' => 'admin.index',
        'icon' => 'fa-home'
    ],
    [
        'label' => 'Quản lí Khuyến Mãi',
        'route' => 'admin.promotion',
        'icon' => 'fa-bullhorn',
        'items' => [
            [
                'label' => 'Danh sách khuyến mãi',
                'route' => 'admin.promotion',
            ],
            [
                'label' => 'Thêm khuyến mãi',
                'route' => 'admin.create-promotion',
            ]
        ]
    ],
    [
        'label' => 'Quản lí danh mục',
        'route' => 'category.index',
        'icon' => 'fa-shopping-cart',
        'items' => [
            [
                'label' => 'Danh sách danh mục',
                'route' => 'category.index',
            ],
            [
                'label' => 'Thêm danh mục',
                'route' => 'category.create',
            ]
        ]
    ],
    [
        'label' => 'Quản lí sản phẩm',
        'route' => 'product.index',
        'icon' => 'fa-shopping-cart',
        'items' => [
            [
                'label' => 'Danh sách sản phẩm',
                'route' => 'product.index',
            ],
            [
                'label' => 'Thêm sản phẩm',
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
        'label' => 'Quản lí hoá đơn',
        'route' => 'order.index',
        'icon' => 'fa-shopping-cart',
        'items' => [
            [
                'label' => 'Danh sách hoá đơn',
                'route' => 'order.index',
            ]
        ]
    ],
    [
        'label' => 'Quản lí khách hàng',
        'route' => 'guest.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'Danh sách khách hàng',
                'route' => 'guest.index',
            ]
        ]
    ],
    [
        'label' => 'Quản lí admin',
        'route' => 'user.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'Danh sách admin',
                'route' => 'user.index',
            ],
            [
                'label' => 'Thêm admin',
                'route' => 'user.create',
            ]
            
        ]
    ]
]

?>