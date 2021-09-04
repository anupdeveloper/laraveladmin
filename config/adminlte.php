<?php

return [

    'admin_url' => env('ADMIN_URL'),
    'website_url' => env('WEBSITE_URL'),
    'email_verify_url' => env('EMAIL_VERIFY_URL'),
    'email_verify_url_mobile' => env('EMAIL_VERIFY_URL_MOBILE'),
    'default_avatar' => env('DEFAULT_AVATAR'),
    'from_email' => env('FROM_EMAIL', 'admin@whichvocation.com'),
    'logo_path' => env('LOGO_PATH'),
    'ticket_images_path' => env('TICKET_IMAGES_PATH'),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'image_tooltip' => 'Upload max 2 MB file. Only .jpg .svg and .png files are allowed to upload.',
    'docs_tooltip' => 'Upload max 2 MB file. Only .jpg .gif .png .svg .doc .docx .xls .xlsx .ods .pdf files are allowed to upload.',
    'whichvocation' => 'Whichvocation',
    'set_password' => 'Whichvocation Recruiter Approved | Set Password',
    'title_prefix' => '',
    'title_postfix' => '',

    'title' => 'Which Vocation',
    'title_prefix' => '',
    'title_postfix' => '',

    'ticket_acknowledgement_subject' => 'Whichvocation Ticket Updates',
    'ticket_acknowledgement_message_sender' => 'You have replied to a ticket',
    'ticket_acknowledgement_message_receiver' => 'You have received a new message on a ticket',
    'thanks_footer' => 'Thank you for using our application!',
    'not_clickable_message' => 'If you’re having trouble clicking the button, copy and paste the URL below into your web browser:',
    'copyright' => 'Copyright © 2021 whichVocation',
    'hello' => 'Hello!',
    'view_ticket' => 'View Ticket',
    'regards' => 'Regards',
    'team' => 'Team',
    'title' => 'Which Vocation',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b></b>',
    'logo_img' => 'images/logo.svg',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'WhichVocation',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin_panel/dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
        /* [
            'text'   => 'search',
            'search' => true,
            'topnav' => true,
        ], */
        [
            'text' => 'dashboard',
            'url'  => 'admin_panel/dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],
        /* ['header' => 'profile'],
        [
            'text' => 'profile',
            'url'  => 'admin_panel/admin_profile',
            'icon' => 'fas fa-fw fa-user',
            'active' => ['admin_panel/admin_profile*'],
        ], */
        ['header' => 'management'],
        /*
        [
            'key' => 'admin_customers_management',
            'text' => 'customers_management',
            'icon' => 'fas fa-fw fa-building',
            'active' => ['admin_panel/customers*'],
            'can' => ['manage_customers'],
            'submenu' => [
                [
                    'text' => 'pending',
                    'icon' => 'fas fa-fw fa-exclamation-circle',
                    'url'  => 'admin_panel/customers/pending',
                    'active' => ['admin_panel/customers/pending*', 'admin_panel/customers/add*'],
                    'can' => ['manage_pending_customers']
                ],
                [
                    'text' => 'Whitelisted',
                    'icon' => 'fas fa-fw fa-check-circle',
                    'url'  => 'admin_panel/customers/whitelisted',
                    'active' => ['admin_panel/customers/whitelisted*'],
                    'can' => ['manage_whitelisted_customers']
                ],
                [
                    'text' => 'rejected',
                    'icon' => 'fas fa-fw fa-times-circle',
                    'url'  => 'admin_panel/customers/rejected',
                    'active' => ['admin_panel/customers/rejected*'],
                    'can' => ['manage_rejected_customers']
                ],
            ],
        ],
        */
        [
            'key' => 'admin_users_management',
            'text' => 'users_management',
            'icon' => 'fas fa-fw fa-users',
            'active' => ['admin_panel/users*'],
            'can' => ['manage_users'],
            'submenu' => [
                [
                    'text' => 'teachers',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin_panel/users/teachers/list',
                    'active' => ['admin_panel/users/teachers*'],
                  //  'can' => ['manage_jobseekers'],
                ],
                [
                    'text' => 'students',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin_panel/users/students/list',
                    'active' => ['admin_panel/users/students*'],
                    //'can' => ['manage_guests'],
                ],
              //  [
              //      'text' => 'recruiters',
              //      'icon' => 'fas fa-fw fa-user-tie',
              //     'url'  => 'admin_panel/users/recruiters/list',
              //      'active' => ['admin_panel/users/recruiters*'],
              //      'can' => ['manage_recruiters'],
              //  ],
                [
                    'text' => 'admins',
                    'icon' => 'fas fa-fw fa-universal-access',
                    'url'  => 'admin_panel/users/admins/list',
                    'active' => ['admin_panel/users/admins*'],
                    'can' => ['manage_admins'],
                ],
            ],
        ],
        /*
        [
            'text' => 'jobs_management',
            'icon' => 'fas fa-fw fa-briefcase',
            'url'  => '#',
            'can' => ['manage_jobs'],
            'submenu' => [
                [
                    'text' => 'published_jobs',
                    'icon' => 'fas fa-fw fa-list',
                    'url'  => 'admin_panel/jobs/list',
                    'active' => ['admin_panel/jobs/list/*', 'admin_panel/jobs/view/*', 'admin_panel/jobs/edit/*'],
                    'can' => ['manage_job'],
                ],
                [
                    'text' => 'suspended_jobs',
                    'icon' => 'fa fa-exclamation-circle',
                    'url'  => 'admin_panel/jobs/suspended/list',
                    'active' => ['admin_panel/jobs/suspended*'],
                    'can' => ['resume_job'],
                ],
                [
                    'text' => 'job_applications',
                    'icon' => 'fab fa-wpforms',
                    'url'  => 'admin_panel/jobs/applications/list',
                    'active' => ['admin_panel/jobs/applications*'],
                    'can' => ['view_job_applications'],
                ],
                [
                    'text' => 'bookmarked_jobs',
                    'icon' => 'fas fa-fw fa-bookmark',
                    'url'  => 'admin_panel/jobs/bookmarked/list',
                    'active' => ['admin_panel/jobs/bookmarked*'],
                    'can' => ['view_job_bookmarks'],
                ],
                [
                    'text' => 'reported_jobs',
                    'icon' => 'fas fa-exclamation-triangle',
                    'url'  => 'admin_panel/jobs/reported/list',
                    'active' => ['admin_panel/jobs/reported*'],
                    'can' => ['view_reported_job'],
                ],
                [
                    'text' => 'jobs_viewed',
                    'icon' => 'fas fa-eye',
                    'url'  => 'admin_panel/jobs/viewed/list',
                    'active' => ['admin_panel/jobs/viewed*'],
                    'can' => ['view_viewed_job'],
                ],
                [
                    'text' => 'jobs_history',
                    'icon' => 'fas fa-fw fa-map-pin',
                    'url'  => 'admin_panel/jobs/history',
                    'active' => ['admin_panel/jobs/history/*', 'admin_panel/jobs/view_job_history/*'],
                    'can' => ['view_job_history'],
                ],
                [
                    'text' => 'job_search_history',
                    'icon' => 'fa fa-history',
                    'url'  => 'admin_panel/jobs/search_history/list',
                    'active' => ['admin_panel/jobs/search_history*'],
                    'can' => ['view_job_search_history'],
                ],
            ],
        ],

        [
            'text' => 'payments',
            'icon' => 'fas fa-fw fa-credit-card',
            'url'  => '#',
            'can' => ['view_payment_transaction'],
            'submenu' => [
                // [
                //     'text' => 'company_credits',
                //     'icon' => 'fas fa-fw fa-coins',
                //     'url'  => 'admin_panel/credits/list',
                //     'active' => ['admin_panel/credits/*'],
                //     'can' => ['manage_credits'],
                // ],
                // [
                //     'text' => 'credits_history',
                //     'icon' => 'fas fa-fw fa-money-check-alt',
                //     'url'  => 'admin_panel/credits_history/list',
                //     'active' => ['admin_panel/credits_history*'],
                //     'can' => ['view_credits_history'],
                // ],
                [
                    'text' => 'payment_transactions',
                    'icon' => 'fab fa-fw fa-cc-stripe',
                    'url'  => 'admin_panel/payment_transactions/list',
                    'active' => ['admin_panel/payment_transactions*'],
                    'can' => ['view_payment_transaction'],
                ],
            ],
        ],
        */
        [
            'text' => 'content_management',
            'icon' => 'fas fa-fw fa-edit',
            'url'  => '#',
            'can' => ['manage_cms'],
            'submenu' => [
                [
                    'text' => 'website',
                    'icon' => 'fas fa-fw fa-laptop',
                    'url'  => 'admin_panel/content/website/list',
                    'active' => ['admin_panel/content/website*'],
                    'can' => ['manage_website_pages'],
                ],
                [
                    'text' => 'mobile',
                    'icon' => 'fas fa-fw fa-mobile',
                    'url'  => 'admin_panel/content/mobile/list',
                    'active' => ['admin_panel/content/mobile*'],
                    'can' => ['manage_mobile_pages'],
                ],
            ],
        ],
        [
            'text' => 'school_management',
            'icon' => 'fas fa-fw fa-school',
            'url'  => '#',
            //'can' => ['manage_cms'],
            'submenu' => [
                [
                    'text' => 'school_management',
                    'icon' => 'fas fa-fw fa-school',
                    'url'  => 'admin_panel/school/list',
                    'active' => ['admin_panel/school/list*'],
                   //  'can' => ['manage_website_pages'],
                ],
            ]
        ],
        [
            'text' => 'course_management',
            'icon' => 'fas fa-fw fa-book',
            'url'  => '#',
            'can' => ['manage_cms'],
            'submenu' => [
                [
                    'text' => 'course',
                    'icon' => 'fas fa-fw fa-book',
                    'url'  => 'admin_panel/course/course/list',
                    'active' => ['admin_panel/course/course*'],
                  //  'can' => ['manage_website_pages'],
                ],
                /*
                [
                    'text' => 'subject',
                    'icon' => 'fas fa-fw fa-book',
                    'url'  => 'admin_panel/course/subject/list',
                    'active' => ['admin_panel/course/subject*'],
                  //  'can' => ['manage_mobile_pages'],
                ],
                */
                [
                    'text' => 'Questions',
                    'icon' => 'fas fa-fw fa-book',
                    'url'  => 'admin_panel/course/questions/list',
                    'active' => ['admin_panel/course/questions*'],
                  //  'can' => ['manage_mobile_pages'],
                ],

            ],
        ],
        /*
        [
            'text' => "Users' Feedback",
            'icon' => 'fas fa-ticket-alt',
            'url'  => '#',
            'active' => ['admin_panel/tickets*'],
            'can' => ['manage_tickets'],
            'submenu' => [
                [
                    'text' => 'tickets',
                    'icon' => 'fas fa-ticket-alt',
                    'url'  => 'admin_panel/tickets/list',
                    'can' => ['manage_tickets'],
                    'active' => ['admin_panel/tickets*'],
                ],
                [
                    'text' => 'feedbacks',
                    'icon' => 'fas fa-comments',
                    'url'  => 'admin_panel/feedbacks/list',
                    'active' => ['admin_panel/feedbacks*'],
                    'can' => ['view_feedback'],
                ],
                [
                    'text' => 'contact_us',
                    'icon' => 'fas fa-envelope',
                    'url'  => 'admin_panel/contact_us/list',
                    'active' => ['admin_panel/contact_us*'],
                    'can' => ['view_contact_us'],
                ],
            ]
        ],

        [
            'text' => 'misc_data_management',
            'icon' => 'fas fa-fw fa-info-circle',
            'url'  => '#',
            'can' => ['manage_misc_data'],
            'submenu' => [
                [
                    'text' => 'job_industries',
                    'icon' => 'fas fa-fw fa-industry',
                    'url'  => 'admin_panel/misc/job_industries/list',
                    'active' => ['admin_panel/misc/job_industries*'],
                    'can' => ['manage_job_industry'],
                ],
                [
                    'text' => 'job_qualifications',
                    'icon' => 'fas fa-fw fa-graduation-cap',
                    'url'  => 'admin_panel/misc/job_qualifications/list',
                    'active' => ['admin_panel/misc/job_qualifications*'],
                    'can' => ['manage_job_qualifications'],
                ],
                /* [
                    'text' => 'job_functions',
                    'icon' => 'fas fa-fw fa-tasks',
                    'url'  => 'admin_panel/misc/job_functions/list',
                    'active' => ['admin_panel/misc/job_functions*'],
                ], */
                // [
                //     'text' => 'job_locations',
                //     'icon' => 'fas fa-fw fa-map-marker',
                //     'url'  => 'admin_panel/misc/job_locations/list',
                //     'active' => ['admin_panel/misc/job_locations*'],
                //     'can' => ['manage_job_location'],
                // ],
              //  [
              //      'text' => 'skills',
              //      'icon' => 'fas fa-fw fa-brain',
              //      'url'  => 'admin_panel/misc/skills/list',
              //      'active' => ['admin_panel/misc/skills*'],
              //      'can' => ['manage_skills'],
              //  ],
                // [
                //     'text' => 'cities',
                //     'icon' => 'fas fa-city',
                //     'url'  => 'admin_panel/misc/cities/list',
                //     'active' => ['admin_panel/misc/cities*'],
                //     'can' => ['manage_cities'],
                // ],
                // [
                //     'text' => 'counties',
                //     'icon' => 'fas fa-flag',
                //     'url'  => 'admin_panel/misc/counties/list',
                //     'active' => ['admin_panel/misc/counties*'],
                //     'can' => ['manage_counties'],
                // ],
          //  ],
      //  ],
      //
        [
            'text' => 'access_control',
            'icon'    => 'fas fa-fw fa-cogs',
            'url'  => '#',
            'active' => ['admin_panel/roles*'],
            'can' => 'manage_access_control',
            'submenu' => [
                [
                    'text' => 'roles',
                    'icon'    => 'fas fa-fw fa-users',
                    'url'  => 'admin_panel/roles/list',
                    'active' => ['admin_panel/roles/list*', 'admin_panel/roles/add*', 'admin_panel/roles/edit*', 'admin_panel/roles/view*'],
                    'can' => 'manage_roles',
                ],
                [
                    'text' => 'permissions',
                    'icon'    => 'fas fa-key',
                    'url'  => 'admin_panel/roles/role_permissions',
                    'active' => ['admin_panel/roles/role_permissions*'],
                    'can' => 'add_permissions',
                ]
            ],
        ],
        [
            'key' => 'admin_recylce_bin',
            'text' => 'recylce_bin',
            'icon' => 'far fa-trash-alt',
            'url'  => '#',
            'active' => ['admin_panel/recycle_bin*'],
            'can' => ['manage_recycle_bin'],
            'submenu' => [
                [
                    'text' => 'customers',
                    'icon' => 'fas fa-fw fa-building',
                    'url'  => 'admin_panel/recycle_bin/customers/deleted',
                    'can' => 'restore_customers',
                ],
                [
                    'text' => 'jobseekers',
                    'icon' => 'fas fa-fw fa-briefcase',
                    'url'  => 'admin_panel/recycle_bin/jobseekers/deleted',
                    'can' => 'restore_jobseekers',
                ],
                [
                    'text' => 'recruiters',
                    'icon' => 'fas fa-fw fa-user-tie',
                    'url'  => 'admin_panel/recycle_bin/recruiters/deleted',
                    'can' => 'restore_recruiters',
                ],
                [
                    'text' => 'admins',
                    'icon' => 'fas fa-fw fa-universal-access',
                    'url'  => 'admin_panel/recycle_bin/admins/deleted',
                    'can' => 'restore_admins',
                ],
                [
                    'text' => 'jobs',
                    'icon' => 'fas fa-fw fa-briefcase',
                    'url'  => 'admin_panel/recycle_bin/jobs/deleted',
                    'can' => 'restore_jobs',
                ],
                [
                    'text' => 'job_industries',
                    'icon' => 'fas fa-fw fa-industry',
                    'url'  => 'admin_panel/recycle_bin/job_industries/deleted',
                    'can' => 'restore_job_industries',
                ],
                [
                    'text' => 'job_qualifications',
                    'icon' => 'fas fa-fw fa-graduation-cap',
                    'url'  => 'admin_panel/recycle_bin/job_qualifications/deleted',
                    'can' => 'restore_job_qualifications',
                ],
                /* [
                    'text' => 'job_functions',
                    'icon' => 'fas fa-fw fa-tasks',
                    'url'  => 'admin_panel/recycle_bin/job_functions/deleted',
                ], */
                // [
                //     'text' => 'job_locations',
                //     'icon' => 'fas fa-fw fa-map-marker',
                //     'url'  => 'admin_panel/recycle_bin/job_locations/deleted',
                //     'can' => 'restore_job_locations',
                // ],
                [
                    'text' => 'skills',
                    'icon' => 'fas fa-fw fa-brain',
                    'url'  => 'admin_panel/recycle_bin/skills/deleted',
                    'can' => 'restore_skills',
                ],
                // [
                //     'text' => 'cities',
                //     'icon' => 'fas fa-city',
                //     'url'  => 'admin_panel/recycle_bin/cities/deleted',
                //     'can' => 'restore_cities',
                // ],
                // [
                //     'text' => 'counties',
                //     'icon' => 'fas fa-flag',
                //     'url'  => 'admin_panel/recycle_bin/counties/deleted',
                //     'can' => 'restore_counties',
                // ],
                [
                    'text' => 'roles',
                    'icon' => 'fas fa-users',
                    'url'  => 'admin_panel/recycle_bin/roles/deleted',
                    'can' => 'restore_roles',
                ],
                /* [
                    'text' => 'website_pages',
                    'icon' => 'fas fa-desktop',
                    'url'  => 'admin_panel/recycle_bin/website/deleted',
                    'can' => 'restore_website_page',
                ],
                [
                    'text' => 'mobile_pages',
                    'icon' => 'fas fa-mobile',
                    'url'  => 'admin_panel/recycle_bin/mobile/deleted',
                    'can' => 'restore_mobile_page',
                ], */
            ],
        ],
        /* [
            'text' => 'logout',
            'icon'    => 'fas fa-fw fa-sign-out-alt',
            'url'  => '#'
        ], */
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'DateRangePicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
