<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => "Controle",

    'title_prefix' => '',

    'title_postfix' => " - Sistema Gerencial",

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => env('ADM_LOGO', 'PDV <b>Laravel</b>'),
    'logo_mini' => env('ADM_LOGO_MIN', 'P<b>L</b>'),

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => env('ADM_SKIN', 'red'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => '',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => '',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MENU',
        [
            'text' => 'Blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Inicio',
            'url'         => '/',
            // 'icon'        => 'file',
            // 'label'       => 4,
            'label_color' => 'success',
        ],
        [
            'text'        => 'Vender',
            'url'         => '/venda',
            'icon'        => 'shopping-cart'
        ],
        [
            'text'       => 'Caixa',
            'url'        => '',
            'icon'       => 'money',
            'submenu' => [
                [
                    'text' => 'Abrir Caixa',
                    'url'  => 'caixa/abrir',
                    'icon' => 'folder-open-o',
                    'icon_color' => 'green'
                ],
                [
                    'text' => 'Fechar Caixa',
                    'url'  => 'caixa/fechar',
                    'icon' => 'folder',
                    'icon_color' => 'red'
                ],
                [
                    'text' => 'Sangria',
                    'url'  => 'caixa/sangria',
                    'icon' => 'money',
                    'icon_color' => 'red'
                ],
                [
                    'text' => 'Adicionar Dinheiro',
                    'url'  => 'caixa/adicionar',
                    'icon' => 'money',
                    'icon_color' => 'green'
                ],
            ]
        ],
        [
            'text'        => 'Clientes',
            'url'         => 'clientes',
            'icon'        => 'address-book',
            'submenu' => [
                [
                    'text' => 'Lista de clientes',
                    'url'  => 'clientes/todos',
                    'icon' => 'list-alt',
                ],
                [
                    'text' => 'Cadastro de clientes',
                    'url'  => 'clientes/cadastrar',
                    'icon' => 'plus-circle',
                    'icon_color' => 'red',
                ],
            ]
        ],
        'TRANSAÇÕES',
        [
            'text' => 'Consulta',
            'url'  => 'historico/'
        ],
        'ESTOQUE',
        [
            'text' => 'Lista de item',
            'url'  => 'estoque/todos',
            'icon' => 'list-alt',
        ],
        [
            'text' => 'Cadastro de item',
            'url'  => 'estoque/cadastrar',
            'icon' => 'plus-circle',
            'icon_color' => 'red',
        ],
        [
            'text' => 'Alterar Atributos',
            'url'  => 'estoque/atributos',
            'icon' => 'pencil',
            'icon_color' => 'green',
        ],
        'ADMINISTRAÇÃO',
        [
            'text' => 'Relatorio de Vendas',
            'url'  => 'relatorio',
            'icon' => 'line-chart',
        ],
        [
            'text' => 'Backup do sistema',
            'url'  => 'relatorio/backup',
            'icon' => 'cloud-upload',
            'icon_color' => 'green',
        ],

        'CONTA',
        // [
        //     'text' => 'Profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'user',
        // ],
        [
            'text' => 'Alterar Usuário/Senha',
            'url'  => 'admin/settings',
            'icon' => 'lock',
        ],
        /*
        [
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text'       => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],
        */
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => false,
        'select2'    => false,
    ],
];
