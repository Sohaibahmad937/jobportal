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

    'accepted' => ' :attribute સ્વીકારવું જ જોઇએ.',
    'active_url' => ' :attribute માન્ય URL નથી.',
    'after' => ' :attribute તારીખ પછીની તારીખ હોવી આવશ્યક છે.',
    'after_or_equal' => ' :attribute તારીખ પછીની અથવા તેની બરાબર તારીખ હોવી આવશ્યક છે.',
    'alpha' => ' :attribute ફક્ત અક્ષરો સમાવી શકે છે.',
    'alpha_dash' => ' :attribute તેમાં ફક્ત અક્ષરો, સંખ્યાઓ, આડંકો અને અન્ડરસ્કોર્સ હોઈ શકે છે.',
    'alpha_num' => ' :attribute ફક્ત અક્ષરો અને સંખ્યાઓ શામેલ હોઈ શકે છે.',
    'array' => ' :attribute એરે હોવું જ જોઈએ.',
    'before' => ' :attribute તારીખ પહેલાંની તારીખ હોવી આવશ્યક છે.',
    'before_or_equal' => ' :attribute તારીખ અથવા તે પહેલાંની તારીખની તારીખ હોવી આવશ્યક છે.',
    'between' => [
        'numeric' => ' :attribute વચ્ચે હોવું જ જોઈએ :min અને :max.',
        'file' => ' :attribute વચ્ચે હોવું જ જોઈએ :min અને :max કિલોબાઇટ્સ.',
        'string' => ' :attribute વચ્ચે હોવું જ જોઈએ :min અને :max અક્ષરો.',
        'array' => ' :attribute વચ્ચે હોવું જ જોઈએ :min અને :max વસ્તુઓ.',
    ],
    'boolean' => ' :attribute ફીલ્ડ સાચા કે ખોટા હોવા જોઈએ.',
    'confirmed' => ' :attribute પુષ્ટિ મેળ ખાતી નથી.',
    'date' => ' :attribute માન્ય તારીખ નથી.',
    'date_equals' => ' :attribute ની સમાન તારીખ હોવી જોઈએ :date.',
    'date_format' => ' :attribute બંધારણ સાથે મેળ ખાતો નથી :format.',
    'different' => ' :attribute અને :or અલગ હોવું જ જોઈએ.',
    'digits' => ' :attribute ચોક્ક્સ હોવુ જોઈએ :digits અંકો.',
    'digits_between' => ' :attributeવચ્ચે હોવું જ જોઈએ :min અને :max અંકો.',
    'dimensions' => ' :attribute અમાન્ય છબી પરિમાણો છે.',
    'distinct' => ' :attribute ફીલ્ડમાં ડુપ્લિકેટ વેલ્યુ છે.',
    'email' => ' :attribute માન્ય ઇમેઇલ સરનામું હોવું આવશ્યક છે.',
    'ends_with' => ' :attribute નીચેનામાંથી એક સાથે સમાપ્ત થવું આવશ્યક છે: :values',
    'exists' => ' પસંદ કરેલ :attribute અમાન્ય છે.',
    'file' => ' :attribute ફાઇલ હોવી જ જોઇએ.',
    'filled' => ' :attribute ફીલ્ડનું મૂલ્ય હોવું આવશ્યક છે.',
    'gt' => [
        'numeric' => ' :attribute કરતા વધારે હોવું જોઈએ :value.',
        'file' => ' :attribute કરતા વધારે હોવું જોઈએ :value કિલોબાઇટ્સ.',
        'string' => ' :attribute કરતા વધારે હોવું જોઈએ:value અક્ષરો.',
        'array' => ' :attributeકરતા વધારે હોવું જોઈએ :value વસ્તુઓ.',
    ],
    'gte' => [
        'numeric' => ' :attribute કરતા વધારે અથવા બરાબર હોવા જોઈએ :value.',
        'file' => ' :attribute કરતા વધારે અથવા બરાબર હોવા જોઈએ :value કિલોબાઇટ્સ.',
        'string' => ' :attribute કરતા વધારે અથવા બરાબર હોવા જોઈએ:value અક્ષરો.',
        'array' => ' :attribute હોવી જ જોઈએ :value વસ્તુઓ અથવા વધુ.',
    ],
    'image' => ' :attribute એક છબી હોવી જ જોઇએ.',
    'in' => ' પસંદ કરેલ :attribute અમાન્ય છે.',
    'in_array' => ' :attribute ક્ષેત્ર અસ્તિત્વમાં નથી :or.',
    'integer' => ' :attribute પૂર્ણાંક હોવો જોઈએ.',
    'ip' => ' :attribute માન્ય IP સરનામું હોવું આવશ્યક છે.',
    'ipv4' => ' :attribute માન્ય IPv4 સરનામું હોવું આવશ્યક છે.',
    'ipv6' => ' :attribute માન્ય IPv6 સરનામું હોવું આવશ્યક છે.',
    'json' => ' :attribute માન્ય JSON શબ્દમાળા હોવી આવશ્યક છે.',
    'lt' => [
        'numeric' => ' :attribute કરતાં ઓછી હોવી જ જોઇએ :value.',
        'file' => ' :attribute કરતાં ઓછી હોવી જ જોઇએ :value કિલોબાઇટ્સ.',
        'string' => ' :attribute કરતાં ઓછી હોવી જ જોઇએ :value અક્ષરો.',
        'array' => ' :attribute કરતાં ઓછી હોવી જ જોઇએ :value વસ્તુઓ.',
    ],
    'lte' => [
        'numeric' => ' :attribute કરતા ઓછા અથવા બરાબર હોવા જોઈએ :value.',
        'file' => ' :attribute કરતા ઓછા અથવા બરાબર હોવા જોઈએ :value કિલોબાઇટ્સ.',
        'string' => ' :attribute કરતા ઓછા અથવા બરાબર હોવા જોઈએ :value અક્ષરો.',
        'array' => ' :attribute કરતાં વધુ ન હોવી જોઈએ :value વસ્તુઓ.',
    ],
    'max' => [
        'numeric' => ' :attribute કરતાં વધુ ન હોઈ શકે :max.',
        'file' => ' :attribute કરતાં વધુ ન હોઈ શકે :max કિલોબાઇટ્સ.',
        'string' => ' :attributeકરતાં વધુ ન હોઈ શકે :max અક્ષરો.',
        'array' => ' :attribute કરતાં વધુ ન હોઈ શકે :max વસ્તુઓ.',
    ],
    'mimes' => ' :attribute આ પ્રકારની ફાઇલ હોવી જ જોઇએ: :values.',
    'mimetypes' => ' :attribute આ પ્રકારની ફાઇલ હોવી જ જોઇએ: :values.',
    'min' => [
        'numeric' => ' :attribute ઓછામાં ઓછું હોવું જોઈએ :min.',
        'file' => ' :attributeઓછામાં ઓછું હોવું જોઈએ :min કિલોબાઇટ્સ.',
        'string' => ' :attribute ઓછામાં ઓછું હોવું જોઈએ :min અક્ષરો.',
        'array' => ' :attribute ઓછામાં ઓછું હોવું જોઈએ :min વસ્તુઓ.',
    ],
    'not_in' => ' પસંદ કરેલ :attribute અમાન્ય છે.',
    'not_regex' => ' :attribute બંધારણ અમાન્ય છે.',
    'numeric' => ' :attribute સંખ્યા હોવી જ જોઇએ.',
    'present' => ' :attribute ક્ષેત્ર હાજર હોવું જ જોઈએ.',
    'regex' => ' :attribute બંધારણ અમાન્ય છે.',
    'required' => ' :attribute ક્ષેત્ર જરૂરી છે.',
    'required_if' => ' :attribute જ્યારે ક્ષેત્ર જરૂરી છે :or છે :value.',
    'required_unless' => ' :attribute જ્યાં સુધી ફીલ્ડ આવશ્યક નથી :or મા છે :values.',
    'required_with' => ' :attribute જ્યારે ક્ષેત્ર જરૂરી છે :values હાજર છે.',
    'required_with_all' => ' :attribute જ્યારે ક્ષેત્ર જરૂરી છે :values હાજર છે.',
    'required_without' => ' :attribute જ્યારે ક્ષેત્ર જરૂરી છે :values હાજર નથી.',
    'required_without_all' => ' :attribute ફીલ્ડ આવશ્યક છે જ્યારે કંઈ નહીં :values હાજર છે.',
    'same' => ' :attribute અને :or મેચ કરવી જ જોઇએ.',
    'size' => [
        'numeric' => ' :attribute ચોક્ક્સ હોવુ જોઈએ :size.',
        'file' => ' :attribute ચોક્ક્સ હોવુ જોઈએ :size કિલોબાઇટ્સ.',
        'string' => ' :attribute ચોક્ક્સ હોવુ જોઈએ :size અક્ષરો.',
        'array' => ' :attribute સમાવવું જ જોઇએ :size વસ્તુઓ.',
    ],
    'starts_with' => ' :attribute નીચેનામાંથી એક સાથે પ્રારંભ થવો આવશ્યક છે: :values',
    'string' => ' :attribute શબ્દમાળા હોવું જ જોઈએ',
    'timezone' => ' :attribute માન્ય ઝોન હોવો આવશ્યક છે.',
    'unique' => ' :attribute પહેલેથી જ લેવામાં આવી છે.',
    'uploaded' => ' :attribute અપલોડ કરવામાં નિષ્ફળ.',
    'url' => ' :attribute બંધારણ અમાન્ય છે.',
    'uuid' => ' :attribute માન્ય UID હોવું આવશ્યક છે.',

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
            'rule-name' => 'કસ્ટમ સંદેશ',
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
    'is Required' => 'જરૂરી છે',
    'already exist in' => 'પહેલેથી જ અસ્તિત્વમાં છે',
    'already exist' => 'પહેલેથી જ અસ્તિત્વમાં',
    
];
