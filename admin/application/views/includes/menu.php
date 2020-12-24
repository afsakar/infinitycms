<?php

$menus = [

    [
        "url" => "/",
        "title" => "Dashboard",
        "icon" => "zmdi zmdi-view-dashboard",
        "permissions" => [
            "show" => "Görüntüleme"
        ]

    ],
    [
        "url" => "settings",
        "title" => "Ayarlar",
        "icon" => "zmdi zmdi-settings",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme"
        ],
        "submenu" => [
            [
                "url" => "settings",
                "title" => "Genel Ayarlar",

            ],
            [
                "url" => "email_settings",
                "title" => "Email Listesi",
                "permissions" => [
                    "show" => "Görüntüleme",
                    "edit" => "Düzenleme",
                    "add" => "Ekleme",
                    "delete" => "Silme"
                ]
            ]
        ]
    ],
    [
        "url" => "users",
        "title" => "Kullanıcılar",
        "icon" => "zmdi zmdi-accounts",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "contact",
        "title" => "İlteişim Mesajları",
        "icon" => "zmdi zmdi-email",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "send" => "Gönderme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "menu",
        "title" => "Menü İşlemleri",
        "icon" => "zmdi zmdi-format-list-bulleted",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "galleries",
        "title" => "Galeriler",
        "icon" => "zmdi zmdi-collection-folder-image",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "sliders",
        "title" => "Slider İşlemleri",
        "icon" => "zmdi zmdi-layers",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "projects",
        "title" => "Projeler",
        "icon" => "fa fa-rocket",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ],
        "submenu" => [
            [
                "url" => "projects",
                "title" => "Proje Listesi"
            ],
            [
                "url" => "projects_category",
                "title" => "Proje Kategorileri",
                "permissions" => [
                    "show" => "Görüntüleme",
                    "edit" => "Düzenleme",
                    "add" => "Ekleme",
                    "delete" => "Silme"
                ]
            ]
        ]
    ],
    [
        "url" => "news",
        "title" => "Haberler",
        "icon" => "fa fa-newspaper",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ],
        "submenu" => [
            [
                "url" => "news",
                "title" => "Haberler",
            ],
            [
                "url" => "comments",
                "title" => "Haber Yorumları",
                "permissions" => [
                    "show" => "Görüntüleme",
                    "edit" => "Düzenleme",
                    "delete" => "Silme"
                ]
            ]
        ]
    ],
    [
        "url" => "courses",
        "title" => "Etkinlikler",
        "icon" => "fa fa-calendar",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "references",
        "title" => "Referanslar",
        "icon" => "zmdi zmdi-check",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "popups",
        "title" => "Popuplar",
        "icon" => "zmdi zmdi-widgets",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "brands",
        "title" => "Markalar",
        "icon" => "zmdi zmdi-present-to-all",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "testimonials",
        "title" => "Müşteri Yorumları",
        "icon" => "zmdi zmdi-comment-text",
        "permissions" => [
            "show" => "Görüntüleme",
            "edit" => "Düzenleme",
            "add" => "Ekleme",
            "delete" => "Silme"
        ]
    ],
    [
        "url" => "members",
        "title" => "Aboneler",
        "icon" => "zmdi zmdi-account-box-mail",
        "permissions" => [
            "show" => "Görüntüleme",
            "delete" => "Silme"
        ]
    ]

];