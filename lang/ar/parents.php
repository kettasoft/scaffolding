<?php

return [
    'plural' => 'اولياء الامور',
    'singular' => 'ولي امر',
    'empty' => 'لا توجد عملاء',
    'select' => 'اختر ولي امر',
    'perPage' => 'عدد النتائج في الصفحة',
    'actions' => [
        'list' => 'كل اولياء الامور',
        'show' => 'عرض',
        'create' => 'إضافة ولي امر جديد',
        'new' => 'إضافة',
        'edit' => 'تعديل  ولي امر',
        'delete' => 'حذف ولي امر',
        'save' => 'حفظ',
        'filter' => 'بحث',
        'block' => 'حظر ولي امر',
        'unblock' => 'الغاء حظر ولي امر',
        'top_customers' => 'اكثر الزبائن شراءا',
    ],
    'messages' => [
        'created' => 'تم إضافة ولي امر بنجاح .',
        'updated' => 'تم تعديل ولي امر بنجاح .',
        'deleted' => 'تم حذف ولي امر بنجاح .',
        'blocked' => 'تم حظر ولي امر بنجاح .',
        'unblocked' => 'تم الغاء حظر ولي امر بنجاح .',
        'images_note' => 'الملفات المدعومة: jpeg ، png ، jpg | الحد الأقصى لحجم الملف: 10 ميجا بايت',
    ],
    'attributes' => [
        'name' => 'اسم ولي امر',
        'phone' => 'رقم الهاتف',
        'email' => 'البريد الالكترونى',
        'created_at' => 'تاريخ الإنضمام',
        'old_password' => 'كلمة المرور القديمة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'type' => 'نوع المستخدم',
        'avatar' => 'الصورة الشخصية',
        'total' => 'اجمالي المشتريات',
        'last_login_at' => 'آخر تسجيل دخول للولي امر',
        'orders' => [
            'count' => 'عدد الطلبات',
            'total' => 'اجمالي الطلبات',
            'average' => 'متوسط اجمالي الطلبات',
        ],
        'location' => 'موقع ولي امر',
        'view_map' => 'عرض على الخريطة',
        'verified' => 'تم التحقق',
        'verified_at' => 'تم التحقق منه في',
        'preferred_locale' => 'اللغة المفضلة',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا ولي امر ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
        'block' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حظر هذا ولي امر ?',
            'confirm' => 'حظر',
            'cancel' => 'إلغاء',
        ],
        'unblock' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد الغاء حظر هذا ولي امر ?',
            'confirm' => 'الغاء حظر',
            'cancel' => 'إلغاء',
        ],
    ],
    'emails' => [
        'welcome' => [
            'subject' => 'مرحبا :user',
            'title' => 'مرحبا بك في :store',
            'content' => 'تم انشاء حسولي امرك بنجاح نتمنالك تجربة ممتعة بالتسوق ',
            'salutation' => 'فريق عمل :store',
        ],
        'new_order' => [
            'subject' => 'طلب شراء جديد',
            'title' => 'طلب شراء جديد',
            'content' => 'تم استقبال طلب شراء جديد',
            'salutation' => 'سوف يتم مراجعة بيانات الطلب وارسالة فريق :store',
            'order_num' => 'رقم الفاتورة',
            'date' => 'تاريخ',
            'product' => 'المنتج',
            'quantity' => 'الكمية',
            'price' => 'السعر',
            'subtotal' => 'المجموع الفرعي',
            'discount' => 'الخصم',
            'shipping_cost' => 'تكلفة الشحن',
            'total' => 'الاجمالي',
        ],
    ],
];
