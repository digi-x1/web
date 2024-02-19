<?php
// URL مقصد
$target_url = $_GET['url'];

// اگر توابع cURL در سرور فعال باشند
if (function_exists('curl_version')) {
    // آرایه اطلاعات درخواست
    $options = array(
        CURLOPT_RETURNTRANSFER => true, // برگشت محتوای درخواست
        CURLOPT_HEADER => false, // عدم نمایش هدر درخواست
        CURLOPT_FOLLOWLOCATION => true, // پیگیری لینک‌های redirect
        CURLOPT_ENCODING => '', // انکدینگ
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'], // User agent
        CURLOPT_AUTOREFERER => true, // ارجاع خودکار
        CURLOPT_CONNECTTIMEOUT => 120, // زمان قطع اتصال
        CURLOPT_TIMEOUT => 120, // زمان انتظار برای پاسخ
        CURLOPT_MAXREDIRS => 10, // حداکثر تعداد redirect
        CURLOPT_SSL_VERIFYPEER => false // اعتبارسنجی گواهی SSL
    );

    // ایجاد یک می‌تواند cURL
    $ch = curl_init($target_url);

    // تنظیم گزینه‌های cURL با استفاده از آرایه options
    curl_setopt_array($ch, $options);

    // اجرای درخواست cURL و گرفتن خروجی
    $content = curl_exec($ch);

    // بستن جلسه cURL
    curl_close($ch);

    // نمایش محتوای دریافتی
    echo $content;
} else {
    // در صورتی که توابع cURL در دسترس نباشند، پیام خطا نمایش داده می‌شود
    echo 'cURL functions are not available. You cannot use this script.';
}
?>
