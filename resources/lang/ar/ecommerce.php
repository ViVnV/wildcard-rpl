<?php

return [
    'group' => 'الطلبات',
    'company' => [
        'title' => 'الشركات',
        'single' => 'شركة',
        'columns' => [
            'country_id' => 'الدولة',
            'name' => 'الاسم',
            'logo' => 'الشعار',
            'ceo' => 'الرئيس التنفيذي',
            'address' => 'العنوان',
            'city' => 'المدينة',
            'zip' => 'الرمز البريدي',
            'registration_number' => 'رقم السجل التجاري',
            'tax_number' => 'السجل الضريبي',
            'email' => 'البريد الإلكتروني',
            'phone' => 'الهاتف',
            'website' => 'الموقع الإلكتروني',
            'notes' => 'ملاحظات',
        ],
    ],
    'branch' => [
        'title' => 'الفروع',
        'single' => 'فرع',
        'columns' => [
            'company_id' => 'الشركة',
            'name' => 'الاسم',
            'phone' => 'الهاتف',
            'branch_number' => 'رقم الفرع',
            'address' => 'العنوان',
        ],
    ],
    'product' => [
        'title' => 'المنتجات',
        'single' => 'منتج',
        'tabs' => [
            'details' => 'التفاصيل',
            'prices' => 'الأسعار',
            'stock' => 'المخزون',
            'seo' => 'تحسين محركات البحث',
            'variation' => 'الخيارات',
        ],
        'filters' => [
            'categories' => 'التصنيفات',
            'category_id' => 'التصنيف الرئيسي',
            'type' => 'النوع',
            'has_options' => 'يحتوي على خيارات',
            'is_activated' => 'مفعل',
            'is_shipped' => 'قابل للشحن',
            'is_trend' => 'متصدر',
            'has_multi_price' => 'يحتوي على أسعار متعددة',
            'has_unlimited_stock' => 'لديه مخزون غير محدود',
            'has_max_cart' => 'لديه حد أقصى للعربة',
            'has_stock_alert' => 'لديه تنبيه مخزون',
            'is_in_stock' => 'متوفر في المخزون',
        ],
        'columns' => [
            'category_id' => 'التصنيف الرئيسي',
            'tags' => 'الوسوم',
            'categories' => 'التصنيفات',
            'feature_image' => 'صورة مميزة',
            'gallery' => 'المعرض',
            'type' => 'النوع',
            'name' => 'الاسم',
            'slug' => 'الرابط',
            'description' => 'الوصف',
            'price' => 'السعر',
            'prices' => 'الأسعار',
            'for' => 'لـ',
            'qty' => 'الكمية',
            'discount' => 'الخصم',
            'discount_to' => 'الخصم حتي',
            'is_activated' => 'مفعل',
            'is_shipped' => 'قابل للشحن',
            'is_trend' => 'متصدر',
            'has_multi_price' => 'يحتوي على أسعار متعددة',
            'has_unlimited_stock' => 'لديه مخزون غير محدود',
            'has_max_cart' => 'لديه حد أقصى للعربة',
            'min_cart' => 'الحد الأدنى للعربة',
            'max_cart' => 'الحد الأقصى للعربة',
            'has_stock_alert' => 'لديه تنبيه مخزون',
            'min_stock_alert' => 'الحد الأدنى لتنبيه المخزون',
            'max_stock_alert' => 'الحد الأقصى لتنبيه المخزون',
            'sku' => 'رمز المنتج',
            'barcode' => 'الباركود',
            'about' => 'حول',
            'details' => 'التفاصيل',
            'vat' => 'الضريبة',
            'keywords' => 'الكلمات الدالة',
            'is_in_stock' => 'متوفر في المخزون',
            'has_options' => 'يحتوي على خيارات',
            'options' => [
                'title' => 'الخيارات',
                'has_custom_price' => 'لديه سعر مخصص',
                'name' => 'الاسم',
                'values' => 'القيم',
                'value' => 'القيمة',
                'vat' => 'الضريبة',
                'price_for' => 'السعر لـ',
                'price' => 'السعر',
                'qty' => 'الكمية',
                'discount' => 'الخصم',
                'discount_to' => 'الخصم حتي',
                'has_color' => 'لديه لون',
                'color' => 'اللون',
            ],
        ],
    ],
    'orders' => [
        'title' => 'الطلبات',
        'single' => 'الطلب',
        'import' => [
            'hint' => 'حتي تستطيع إستيراد الطلبات الجديدة برجاء إملي النص التالي بالبيانات ويمكنك استخدم [SKU*QTY,] بهذا الشكل للمنتجات',
            'order_text' => 'نص الطلب',
        ],
        'actions' => [
            'coupon' => [
                'success' => 'تم تطبيق الكوبون بنجاح',
                'not_valid' => 'الكوبون غير صالح',
                'not_found' => 'الكوبون غير موجود',
            ],
            'apply' => 'تطبيق',
            'approved' => 'الموافقة',
            'shipping' => 'الشحن',
            'status' => 'تغيير الحالة',
            'edit' => 'تعديل الطلب',
            'show' => 'عرض الطلب',
            'print' => 'طباعة',
            'settings' => 'إعدادات الطلب',
            'import' => 'استيراد الطلبات',
            'export' => 'تصدير الطلبات',
        ],
        'sections' => [
            'company' => 'بيانات الشركة',
            'account' => 'بيانات الحساب',
            'location' => 'بيانات الموقع',
            'items' => 'المنتجات',
            'totals' => 'الإجماليات',
        ],
        'filters' => [
            'company' => 'الشركة',
            'branch_id' => 'الفرع',
            'account_id' => 'الحساب',
            'user_id' => 'المستخدم',
            'is_closed' => 'مكتمل',
            'is_approved' => 'تم التاكيد',
            'status' => 'الحالة',
            'payment_method' => 'طريقة الدفع',
            'source' => 'المصدر',
            'country_id' => 'الدولة',
            'city_id' => 'المدينة',
            'area_id' => 'المنطقة',
            'has_returns' => 'لديه مرتجعات',
            'reason' => 'السبب',
        ],
        'status' => [
            'pending' => 'قيد الانتظار',
            'prepear' => 'قيد التجهيز',
            'withdrew' => 'تم الصرف',
            'part-delivered' => 'تم توصيل جزئي',
            'shipped' => 'تم الشحن',
            'delivered' => 'تم التوصيل',
            'canceled' => 'تم الإلغاء',
            'returned' => 'تم الإرجاع',
        ],
        'columns' => [
            'coupon' => 'كوبون الخصم',
            'shipping_vendor_id' => 'شركة الشحن',
            'shipper_id' => 'عامل التوصيل',
            'company_id' => 'الشركة',
            'branch_id' => 'الفرع',
            'status' => 'الحالة',
            'payment_method' => 'طريقة الدفع',
            'notes' => 'ملاحظات',
            'user_id' => 'المستخدم',
            'account_id' => 'الحساب',
            'name' => 'الاسم',
            'phone' => 'الهاتف',
            'source' => 'المصدر',
            'country_id' => 'الدولة',
            'city_id' => 'المدينة',
            'area_id' => 'المنطقة',
            'flat' => 'الشقة',
            'address' => 'العنوان',
            'items' => 'العناصر',
            'product_id' => 'المنتج',
            'price' => 'السعر',
            'qty' => 'الكمية',
            'discount' => 'الخصم',
            'vat' => 'الضريبة',
            'total' => 'الإجمالي',
            'shipping' => 'الشحن',
            'has_returns' => 'لديه مرتجعات',
            'return_total' => 'إجمالي المرتجعات',
            'reason' => 'السبب',
            'is_approved' => 'تم التاكيد',
            'is_closed' => 'مكتمل',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
            'uuid' => 'كود الطلب',
        ],
        'print' => [
            'coupon' => 'كوبون الخصم',
            'from' => 'من:',
            'to' => 'إلى:',
            'order' => 'الطلب: ',
            'printed_at' => 'تاريخ الطباعة: ',
            'casher_id' => 'الكاشير:',
            'billed_to' => 'المستحق لـ:',
            'total' => 'الإجمالي',
            'qty' => 'الكمية',
            'price' => 'السعر',
            'discount' => 'الخصم',
            'vat' => 'الضريبة',
            'shipping' => 'الشحن',
            'sub_total' => 'الإجمالي الفرعي',
            'item' => 'العنصر',
            'issue_date' => 'تاريخ الإصدار',
            'due_date' => 'تاريخ الاستحقاق',
            'status' => 'الحالة',
            'payment_method' => 'طريقة الدفع',
            'source' => 'المصدر',
        ],
    ],
    'shipping' => [
        'title' => 'شركات الشحن',
        'single' => 'شركة شحن',
        'columns' => [
            'name' => 'الاسم',
            'contact_person' => 'الشخص المسؤول',
            'delivery_estimation' => 'يتم التوصيل خلال',
            'phone' => 'الهاتف',
            'address' => 'العنوان',
            'is_activated' => 'مفعل',
            'logo' => 'الشعار',
            'price' => 'السعر',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ],
    ],
    'deliveries' => [
        'title' => 'عامل التوصيل',
        'single' => 'عامل',
        'columns' => [
            'shipping_vendor_id' => 'شركة الشحن',
            'name' => 'الاسم',
            'phone' => 'الهاتف',
            'address' => 'العنوان',
            'is_activated' => 'مفعل',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ],
    ],
    'shipping_prices' => [
        'title' => 'أسعار الشحن',
        'single' => 'سعر الشحن',
        'columns' => [
            'type' => 'النوع',
            'delivery' => 'لعامل التوصيل',
            'all' => 'لجميع عمليات التوصيل',
            'delivery_id' => 'عامل التوصيل',
            'country_id' => 'الدولة',
            'city_id' => 'المدينة',
            'area_id' => 'المنطقة',
            'price' => 'السعر',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ],
    ],
    'product_reviews' => [
        'title' => 'تقييمات المنتجات',
        'single' => 'تقييم المنتج',
        'columns' => [
            'account_id' => 'الحساب',
            'rate' => 'التقييم',
            'review' => 'التعليق',
            'is_activated' => 'مفعل',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ],
    ],
    'order_logs' => [
        'title' => 'سجل الطلبات',
        'single' => 'سجل الطلب',
        'columns' => [
            'order_id' => 'الطلب',
            'user_id' => 'المستخدم',
            'is_closed' => 'مغلق',
            'status' => 'الحالة',
            'note' => 'الملاحظة',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ],
    ],
    'settings' => [
        'group' => 'إعدادات الطلبات',
        'receipt' => [
            'title' => 'إعدادات الفاتورة',
            'description' => 'تعديل إعدادات الفاتورة وتغيير الشعار والبيانات الخاصة بالشركة',
            'columns' => [
                'ordering_show_company_data' => 'عرض بيانات الشركة',
                'ordering_show_company_logo' => 'عرض شعار الشركة',
                'ordering_show_branch_data' => 'عرض بيانات الفرع',
                'ordering_show_tax_number' => 'عرض الرقم الضريبي',
                'ordering_show_registration_number' => 'عرض رقم السجل التجاري',
            ],
        ],
        'orders' => [
            'title' => 'إعدادات الطلبات',
            'description' => 'تغيير رمز الطلب وتعديل الفروع و تفعيل رسوم الشحن',
            'sections' => [
                'ordering' => 'إعدادات الطلبات',
                'shipping' => 'إعدادات الشحن',
            ],
            'columns' => [
                'ordering_stating_code' => 'رمز البداية للطلبات',
                'ordering_company_id' => 'الشركة',
                'ordering_web_branch' => 'الفرع الرئيسي لطلبات الموقع',
                'ordering_mobile_branch' => 'الفرع الرئيسي لطلبات التطبيق',
                'ordering_direct_branch' => 'الفرع الرئيسي لطلبات المباشرة',
                'ordering_active_shipping_fees' => 'تفعيل رسوم الشحن',
                'ordering_shipping_fees' => 'رسوم الشحن',
            ],
        ],
        'status' => [
            'title' => 'إعدادات الحالات',
            'description' => 'تعديل حالات الطلبات وتغيير الأيقونات والألوان',
            'action' => [
                'edit' => 'تعديل الحالة',
                'notification' => 'تم تعديل الحالة بنجاح',
            ],
            'columns' => [
                'status' => 'الحالة',
                'icon' => 'أيقونة',
                'color' => 'لون',
                'language' => 'اللغة',
                'value' => 'القيمة',
            ],
        ],
    ],
    'widget' => [
        'state' => 'الطلبات هذا الاسبوع حسب الحالة',
        'orders' => 'طلب',
        'source' => 'مقارنة مصادر الطلبات',
        'payment' => 'مقارنة طرق الدفع',
    ],
    'coupons' => [
        'title' => 'كوبونات الخصم',
        'single' => 'كوبون',
        'columns' => [
            'code' => 'الكود',
            'copy' => 'نسخ',
            'type' => 'النوع',
            'discount_coupon' => 'خصم',
            'percentage_coupon' => 'نسبة',
            'amount' => 'القيمة',
            'end_at' => 'تاريخ الانتهاء',
            'is_activated' => 'مفعل',
            'is_limited' => 'محدود',
            'apply_to' => 'تطبيق علي',
            'product' => 'المنتج',
            'category' => 'التصنيف',
            'except' => 'ما عدا',
            'use_limit' => 'حد الاستخدام',
            'use_limit_by_user' => 'حد الاستخدام للمستخدم',
            'order_total_limit' => 'حد الطلب الإجمالي',
            'is_marketing' => 'تسويقي',
            'marketer_name' => 'اسم المسوق',
            'marketer_type' => 'نوع المسوق',
            'marketer_amount' => 'قيمة المسوق',
            'marketer_amount_max' => 'أقصي قيمة للمسوق',
            'marketer_show_amount_max' => 'عرض أقصي قيمة للمسوق',
            'marketer_hide_total_sales' => 'إخفاء إجمالي المبيعات',
        ],
        'filters' => [
            'type' => 'النوع',
            'is_activated' => 'مفعل',
            'is_limited' => 'محدود',
            'is_marketing' => 'تسويقي',
        ],
    ],
    'gift_card' => [
        'title' => 'بطاقات الهدايا',
        'single' => 'بطاقة هدية',
        'columns' => [
            'default' => 'بطاقة هدية',
            'account_id' => 'الحساب',
            'name' => 'الاسم',
            'code' => 'الكود',
            'balance' => 'الرصيد',
            'is_activated' => 'مفعل',
            'is_expired' => 'منتهي',
        ],
        'filters' => [
            'account_id' => 'الحساب',
            'is_activated' => 'مفعل',
            'is_expired' => 'منتهي',
        ],
    ],
    'referral_code' => [
        'title' => 'رموز الإحالة',
        'single' => 'رمز إحالة',
        'columns' => [
            'default' => 'رمز إحالة',
            'account_id' => 'الحساب',
            'name' => 'الاسم',
            'code' => 'الكود',
            'is_activated' => 'مفعل',
            'is_public' => 'عام',
            'counter' => 'العداد',
        ],
        'filters' => [
            'account_id' => 'الحساب',
            'is_activated' => 'مفعل',
            'is_public' => 'عام',
        ],
    ],
];
