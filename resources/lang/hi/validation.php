<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain  default error messages used by
    |  validator class. Some of se rules have multiple versions such
    | as  size rules. Feel free to tweak each of se messages here.
    |
    */

    'accepted' => ' :attribute स्वीकार करना होगा।',
    'active_url' => ' :attribute एक मान्य URL नहीं है।',
    'after' => ' :attribute तारीख के बाद की तारीख होनी चाहिए।',
    'after_or_equal' => ' :attribute तारीख के बाद या उसके बराबर की तारीख होनी चाहिए।',
    'alpha' => ' :attribute केवल पत्र हो सकते हैं।',
    'alpha_dash' => ' :attribute केवल अक्षर, संख्या, डैश और अंडरस्कोर हो सकते हैं।',
    'alpha_num' => ' :attribute केवल अक्षर और संख्याएँ हो सकती हैं।',
    'array' => ' :attribute एक सरणी होनी चाहिए।',
    'before' => ' :attribute इससे पहले की तारीख होनी चाहिए: तारीख।',
    'before_or_equal' => ' :attribute इससे पहले या इसके बराबर की तारीख होनी चाहिए: तारीख।',
    'between' => [
        'numeric' => ' :attribute के बीच होना चाहिए: :min और :max',
        'file' => ' :attribute के बीच होना चाहिए: :min और :max किलोबाइट।',
        'string' => ' :attribute बीच होना चाहिए: :min और :max वर्ण।',
        'array' => ' :attribute के बीच होना चाहिए: :min और :max आइटम।',
    ],
    'boolean' => ' :attribute क्षेत्र सही या गलत होना चाहिए।',
    'confirmed' => ' :attribute पुष्टि मेल नहीं खाती।',
    'date' => ' :attribute मान्य तिथि नहीं है।',
    'date_equals' => ' :attribute तारीख के बराबर तारीख होनी चाहिए।',
    'date_format' => ' :attribute प्रारूप से मेल नहीं खाता: प्रारूप।',
    'different' => ' :attribute और: या अलग होना चाहिए।',
    'digits' => ' :attribute होना चाहिए: अंक अंक।',
    'digits_between' => ' :attribute के बीच होना चाहिए: न्यूनतम और: अधिकतम अंक।',
    'dimensions' => ' :attribute अमान्य छवि आयाम हैं।',
    'distinct' => ' :attribute फ़ील्ड का डुप्लिकेट मान है।',
    'email' => ' :attribute एक वैध ई - मेल पता होना चाहिए।',
    'ends_with' => ' :attribute निम्नलिखित में से किसी एक के साथ समाप्त होना चाहिए: मान',
    'exists' => ' चुने हुए :attribute अमान्य है।',
    'file' => ' :attribute must एक फ़ाइल हो।',
    'filled' => ' :attribute field मान होना चाहिए।',
    'gt' => [
        'numeric' => ' :attribute से अधिक होना चाहिए :value.',
        'file' => ' :attribute से अधिक होना चाहिए :value किलोबाइट.',
        'string' => ' :attribute से अधिक होना चाहिए :value पात्र.',
        'array' => ' :attribute से अधिक होना चाहिए :value आइटम.',
    ],
    'gte' => [
        'numeric' => ' :attribute से अधिक या बराबर होना चाहिए :value.',
        'file' => ' :attribute से अधिक या बराबर होना चाहिए :value किलोबाइट.',
        'string' => ' :attribute से अधिक या बराबर होना चाहिए :value पात्र.',
        'array' => ' :attribute होना आवश्यक है :value आइटम या ज्यादा.',
    ],
    'image' => ' :attribute एक छवि होनी चाहिए.',
    'in' => ' चुने हुए :attribute अमान्य है।',
    'in_array' => ' :attribute फ़ील्ड में मौजूद नहीं है :or.',
    'integer' => ' :attribute पूर्णांक होना चाहिए.',
    'ip' => ' :attribute एक मान्य IP पता होना चाहिए.',
    'ipv4' => ' :attribute एक मान्य IPv4 पता होना चाहिए.',
    'ipv6' => ' :attribute एक मान्य IPv6 पता होना चाहिए.',
    'json' => ' :attribute एक वैध JSON स्ट्रिंग होना चाहिए.',
    'lt' => [
        'numeric' => ' :attribute से कम होना चाहिए: मूल्य।',
        'file' => ' :attribute से कम होना चाहिए :value किलोबाइट.',
        'string' => ' :attribute से कम होना चाहिए :value पात्र.',
        'array' => ' :attribute से कम होना चाहिए :value आइटम.',
    ],
    'lte' => [
        'numeric' => ' :attribute से कम या बराबर होना चाहिए :value.',
        'file' => ' :attribute से कम या बराबर होना चाहिए :value किलोबाइट.',
        'string' => ' :attribute से कम या बराबर होना चाहिए :value पात्र.',
        'array' => ' :attribute से कम या बराबर होना चाहिए :value आइटम.',
    ],
    'max' => [
        'numeric' => ' :attribute से अधिक नहीं हो सकता है :max.',
        'file' => ' :attribute से अधिक नहीं हो सकता है :max किलोबाइट.',
        'string' => ' :attribute से अधिक नहीं हो सकता है :max पात्र.',
        'array' => ' :attribute से अधिक नहीं हो सकता है :max आइटम.',
    ],
    'mimes' => ' :attribute एक प्रकार की फ़ाइल होनी चाहिए: :values.',
    'mimetypes' => ' :attribute एक प्रकार की फ़ाइल होनी चाहिए: :values.',
    'min' => [
        'numeric' => ' :attribute कम से कम होना चाहिए :min.',
        'file' => ' :attribute कम से कम होना चाहिए :min किलोबाइट.',
        'string' => ' :attribute कम से कम होना चाहिए :min पात्र.',
        'array' => ' :attribute कम से कम होना चाहिए :min आइटम.',
    ],
    'not_in' => 'चुने हुए :attribute अमान्य है।',
    'not_regex' => ' :attribute प्रारूप अमान्य है.',
    'numeric' => ' :attribute एक संख्या होनी चाहिए.',
    'present' => ' :attribute फ़ील्ड मौजूद होना चाहिए.',
    'regex' => ' :attribute प्रारूप अमान्य है.',
    'required' => ' :attribute क्षेत्र की आवश्यकता है.',
    'required_if' => ' :attribute जब फ़ील्ड आवश्यक हो :or है :value.',
    'required_unless' => ' :attribute जब तक फ़ील्ड आवश्यक है :or में है :values.',
    'required_with' => ' :attribute जब फ़ील्ड आवश्यक हो :values उपस्थित है.',
    'required_with_all' => ' :attribute जब फ़ील्ड आवश्यक हो :values मौजूद हैं.',
    'required_without' => ' :attribute जब फ़ील्ड आवश्यक हो :values मौजूद नहीं है.',
    'required_without_all' => ' :attribute फ़ील्ड की आवश्यकता तब होती है जब कोई भी नहीं होता है :values मौजूद हैं.',
    'same' => ' :attribute तथा :or मेल खाना चाहिए.',
    'size' => [
        'numeric' => ' :attribute होना चाहिए :size.',
        'file' => ' :attribute होना चाहिए :size किलोबाइट.',
        'string' => ' :attribute होना चाहिए :size पात्र.',
        'array' => ' :attribute शामिल होना चाहिए :size आइटम.',
    ],
    'starts_with' => ' :attributeनिम्नलिखित में से किसी एक के साथ शुरू होना चाहिए: :values',
    'string' => ' :attribute एक तार होना चाहिए.',
    'timezone' => ' :attribute एक वैध क्षेत्र होना चाहिए.',
    'unique' => ' :attribute has already been taken.',
    'uploaded' => ' :attribute अपलोड करने में विफल.',
    'url' => ' :attribute प्रारूप अमान्य है.',
    'uuid' => ' :attribute एक वैध यूयूआईडी होना चाहिए.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using 
    | convention "attribute.rule" to name  lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'सीमा शुल्क संदेश',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    |  following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
    'is Required' => 'आवश्यक है',
    'already exist in' => 'पहले से मौजूद है',
    'already exist' => 'पहले से ही मौजूद',
    
];
