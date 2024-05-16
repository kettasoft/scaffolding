<?php

return [
    'plural' => 'العضويات',
    'types' => [
        \Modules\Accounts\Entities\User::ADMIN_TYPE => 'مسئول',
        \Modules\Accounts\Entities\User::PARENT_TYPE => 'عميل',
    ],
    'messages' => [
        'block' => 'تم حظر هذا الحساب برجاء المراجعه مع الادارة',
        'verified' => 'لم يتم التحقق من هذا الحساب ، لقد أرسلنا لك رسالة نصية قصيرة تحتوي على كود',
        'password' => 'كلمة المرور غير صحيحة ، الرجاء إدخال كلمة المرور الصحيحة',
    ],
];
