<?php
return [
    [
        'name'    =>  'news',
        'icon'    =>  'glyphicon glyphicon-camera',
        'route'   =>  'admin.news.index',
        'hide'    =>  false,

    ],
    [
        'name'    =>  'account',
        'icon'    =>  'glyphicon glyphicon-user',
        'route'   =>  'admin.users.groups.index',
        'hide'    =>  false,
        'child'   =>  [

            [
                'name'  =>  'admin_account',
                'icon'  =>  'fa fa-circle-o',
                'route' =>  'admin.users.index',
                'hide'  =>  false,
            ],
        ]
    ],
];