<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Câmpul :attribute trebuie să fie acceptat.',
    'active_url'           => ':attribute nu este un URL valid.',
    'after'                => ':Attribute trebuie să fie o dată după :date.',
    'after_or_equal'       => ':Attribute trebuie să fie o dată după sau egală cu :date.',
    'alpha'                => 'Câmpul :attribute trebuie să conțină numai litere.',
    'alpha_dash'           => 'Câmpul :attribute poate conține numai litere, numere și cratime.',
    'alpha_num'            => 'Câmpul :attribute poate conține numai litere și numere.',
    'array'                => 'Câmpul :attribute trebuie să fie un array.',
    'before'               => 'Câmpul :attribute trebuie să fie o dată înainte de :date.',
    'before_or_equal'      => 'Câmpul :attribute trebuie să fie o dată înainte sau egală cu :date.',
    'between'              => [
        'numeric' => 'Câmpul :attribute trebuie să fie între :min și :max.',
        'file'    => 'Câmpul :attribute trebuie să aibă între :min și :max kilobiți.',
        'string'  => 'Câmpul :attribute trebuie să aibă între :min și :max caractere.',
        'array'   => 'Câmpul :attribute trebuie să aibă între :min și :max itemi.',
    ],
    'boolean'              => 'Câmpul :attribute trebuie să fie adevărat sau fals.',
    'confirmed'            => 'Câmpul :attribute nu corespunde cu confirmarea sa.',
    'date'                 => 'Câmpul :attribute nu este o dată validă.',
    'date_format'          => 'Câmpul :attribute nu corespunde cu formatul :format.',
    'different'            => 'Câmpurile :attribute și :other trebuie să fie diferite.',
    'digits'               => 'Câmpul :attribute trebuie să aiba :digits cifre.',
    'digits_between'       => 'Câmpul :attribute trebuie să aibă între :min și :max cifre.',
    'dimensions'           => 'Câmpul :attribute are dimensiuni invalide.',
    'distinct'             => 'Câmpul :attribute are o valoare identică.',
    'email'                => 'Câmpul :attribute trebuie să fie o adresă validă de e-mail.',
    'exists'               => 'Atributul :attribute este invalid.',
    'file'                 => 'Atributul :attribute trebuie să fie un fișier.',
    'filled'               => 'Câmpul :attribute trebuie să conțină o valoare.',
    'image'                => 'Atributul :attribute trebuie să fie o imagine.',
    'in'                   => 'Atributul :attribute este invalid.',
    'in_array'             => 'Câmpul :attribute nu există în :other.',
    'integer'              => 'Atributul :attribute trebuie să fie un întreg.',
    'ip'                   => 'Atributul :attribute trebuie să fie o adresă IP validă.',
    'ipv4'                 => 'Atributul :attribute trebuie să fie o adresă IPv4 validă.',
    'ipv6'                 => 'Atributul :attribute trebuie să fie o adresă IPv6 validă.',
    'json'                 => 'Atributul :attribute trebuie să fie un string JSON valid.',
    'max'                  => [
        'numeric' => 'Atributul :attribute nu poate fi mai mare decât :max.',
        'file'    => 'Atributul :attribute nu poate avea mai mult de :max kilobiți.',
        'string'  => 'Atributul :attribute nu poate avea mai mult de :max caractere.',
        'array'   => 'Atributul :attribute nu poate avea mai mult de :max itemi.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Atributul :attribute trebuie să fie măcar :min.',
        'file'    => 'Atributul :attribute trebuie să aibă măcar :min kilobiți.',
        'string'  => 'Atributul :attribute trebuie să conțină măcar :min caractere.',
        'array'   => 'Atributul :attribute trebuie să aibă măcar :min itemi.',
    ],
    'not_in'               => 'Atributul :attribute este invalid.',
    'numeric'              => 'Atributul :attribute trebuie să fie un număr.',
    'present'              => 'Câmpul :attribute trebuie să existe.',
    'regex'                => 'Formatul atributului :attribute este invalid.',
    'required'             => 'Câmpul :attribute este necesar.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'file.*.file_description' => 'file description',
        'password' => 'parola',
        'confirm-password' => 'confirmarea parolei'
    ],

];
