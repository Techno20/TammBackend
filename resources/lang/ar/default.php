<?php

return [
    'error_message' => [
        'default' => 'فشلت العملية',
        'order_not_found' => 'الطلبية غير موجودة',
        'user_not_found' => 'المستخدم غير موجود',
        'user_has_orders' => 'لا يمكنك حذف المستخدم لانه يمتلك طلبات مسبقه',
        'service_not_found' => 'الخدمة غير موجودة',
        'conversation_not_found' => 'المحادثة غير موجودة',
        'invalid_fields' => 'يرجى التأكد من الحقول جيداً',
        'email_send_failed' => 'فشل ارسالة الرسالة',
        'extension_not_allowed' => 'نوع الملف المرفوع غير مسموح به',
        'service_has_orders' => 'الخدمة تحتوي على طلبيات لا يمكنك حذفها'
    ],
    'success_message' => [
        'default' => 'نجاح',
        'user_registered' => 'تم تسجيل المستخدم بنجاح',
        'code_already_sent' => 'الرمز مرسل من قبل',
        'service_saved' => 'تم حفظ الخدمة بنجاح',
        'service_deleted' => 'تم حذف الخدمة بنجاح',
        'email_sent' => 'تم ارسال الرسالة بنجاح',
        'reset_code_sent' => 'تم ارسال رمز استرجاع كلمة السر على البريد الألكتروني'
    ],
    'other' => [
        'order_status' => ['canceled' => 'ملغي','current' => 'جاري التنفيذ','delivered' => 'تم الانتهاء'],
        'delivery' => [
            'same_day' => 'نفس اليوم',
            'x_day' => ':day يوم'
        ],
        'transaction_types' => [
            'deposit' => 'شحن',
            'withdraw' => 'سحب',
            'refund' => 'استرجاع المبلغ',
            'profit' => 'ربح',
            'charge' => 'استقطاع'
       ],
       'transaction_withdraw_status' => [
            'requested' => 'بالانتظار',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض'
       ],
        'main_category_types' => ['technical' => 'تقنية','consultation' => 'استشارات','training' => 'تدريب'],
        'all_rights_reserved' => 'جميع الحقوق محفوظة منصة تم :year'
    ]
];
