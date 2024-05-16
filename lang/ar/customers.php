<?php

return [
    'plural' => 'العملاء',
    'singular' => 'العميل',
    'empty' => 'لا توجد عملاء',
    'select' => 'اختر العميل',
    'perPage' => 'عدد النتائج في الصفحة',
    'actions' => [
        'list' => 'كل العملاء',
        'show' => 'عرض',
        'create' => 'إضافة عميل جديد',
        'new' => 'إضافة',
        'edit' => 'تعديل  العميل',
        'delete' => 'حذف العميل',
        'save' => 'حفظ',
        'filter' => 'بحث',
        'block' => 'حظر العميل',
        'unblock' => 'الغاء حظر العميل',
        'top_customers' => 'اكثر الزبائن شراءا',
    ],
    'messages' => [
        'created' => 'تم إضافة العميل بنجاح .',
        'updated' => 'تم تعديل العميل بنجاح .',
        'deleted' => 'تم حذف العميل بنجاح .',
        'blocked' => 'تم حظر العميل بنجاح .',
        'unblocked' => 'تم الغاء حظر العميل بنجاح .',
        'images_note' => 'الملفات المدعومة: jpeg ، png ، jpg | الحد الأقصى لحجم الملف: 10 ميجا بايت',
    ],
    'attributes' => [
        'name' => 'اسم العميل',
        'phone' => 'رقم الهاتف',
        'email' => 'البريد الالكترونى',
        'created_at' => 'تاريخ الإنضمام',
        'old_password' => 'كلمة المرور القديمة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'type' => 'نوع المستخدم',
        'avatar' => 'الصورة الشخصية',
        'total' => 'اجمالي المشتريات',
        'last_login_at' => 'آخر تسجيل دخول للعميل',
        'orders' => [
            'count' => 'عدد الطلبات',
            'total' => 'اجمالي الطلبات',
            'average' => 'متوسط اجمالي الطلبات',
        ],
        'location' => 'موقع العميل',
        'view_map' => 'عرض على الخريطة',
        'verified' => 'تم التحقق',
        'verified_at' => 'تم التحقق منه في',
        'preferred_locale' => 'اللغة المفضلة',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا العميل ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
        'block' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حظر هذا العميل ?',
            'confirm' => 'حظر',
            'cancel' => 'إلغاء',
        ],
        'unblock' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد الغاء حظر هذا العميل ?',
            'confirm' => 'الغاء حظر',
            'cancel' => 'إلغاء',
        ],
    ],
    'emails' => [
        'welcome' => [
            'subject' => 'مرحبا :user',
            'title' => 'مرحبا بك في :store',
            'content' => 'تم انشاء حسابك بنجاح نتمنالك تجربة ممتعة بالتسوق ',
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
