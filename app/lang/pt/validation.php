<?php

return array(

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

    "accepted" => "O campo :attribute precisa ser aceito.",
    "active_url" => ":attribute não é uma URL válida.",
    "after" => "A data :attribute precisa ser posterior a :date.",
    "alpha" => "O campo :attribute só pode conter letras.",
    "alpha_dash" => "O campo :attribute só pode conter letras, números e hífens.",
    "alpha_num" => "O campo :attribute só pode conter letras e números.",
    "array" => "O campo :attribute precisa ser uma lista.",
    "before" => "O campo :attribute precisa ser anterior a :date.",
    "between" => array(
        "numeric" => "O campo :attribute precisa estar entre :min e :max.",
        "file" => "O arquivo :attribute precisa ter tamanho entre :min e :max KB.",
        "string" => "O campo :attribute precisa ter de :min a :max caracteres.",
        "array" => "O campo :attribute precisa ter entre :min e :max itens.",
    ),
    "confirmed" => "O campo :attribute não corresponde à sua confirmação.",
    "date" => "O campo :attribute não é uma data válida.",
    "date_format" => "O campo :attribute não corresponde ao formato :format.",
    "different" => ":attribute e :other precisam ser diferentes.",
    "digits" => ":attribute precisa ter :digits digitos.",
    "digits_between" => ":attribute precisa estar entre :min e :max digitos.",
    "email" => "O formato de :attribute é inválido.",
    "exists" => "O valor selecionado para :attribute é inválido.",
    "image" => ":attribute precisa ser uma imagem.",
    "in" => "O valor selecionado para :attribute é inválido.",
    "integer" => ":attribute precisa ser inteiro.",
    "ip" => ":attribute precisa ser um endereço IP válido.",
    "max" => array(
        "numeric" => ":attribute não pode ser maior que :max.",
        "file" => ":attribute não pode ser maior que :max KB.",
        "string" => "O tamanho de :attribute não pode ser maior que :max caracteres.",
        "array" => ":attribute não pode ter mais que :max itens.",
    ),
    "mimes" => ":attribute precisa ser um arquivo de extensão: :values.",
    "min" => array(
        "numeric" => ":attribute precisa ser pelo menos :min.",
        "file" => ":attribute precisa ter pelo menos :min KB.",
        "string" => ":attribute precisa ter pelo menos :min caracteres.",
        "array" => ":attribute precisa ter pelo menos :min itens.",
    ),
    "not_in" => "O valor selecionado para :attribute é inválido.",
    "numeric" => ":attribute precisa ser um número.",
    "regex" => "O formato de :attribute é inválido.",
    "required" => "O campo :attribute é obrigatório.",
    "required_if" => "O campo :attribute é obrigatório quando :other é :value.",
    "required_with" => "O campo :attribute é obrigatório quando :values são selecionados.",
    "required_without" => "O campo :attribute é obrigatório quando :values não estão selecionados.",
    "same" => ":attribute e :other precisam ser iguais.",
    "size" => array(
        "numeric" => ":attribute deve ter :size.",
        "file" => ":attribute deve ter :size KB.",
        "string" => ":attribute deve ter :size caracteres.",
        "array" => ":attribute deve conter :size itens.",
    ),
    "unique" => ":attribute já foi escolhido.",
    "url" => "O formato de :attribute é inválido.",

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

    'custom' => array(),

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

    'attributes' => array(
        'vehiclebodystyle_id' => 'Categoria',
        'vehiclemake_id' => 'Fabricante',
        'vehiclemodelseries_id' => 'Versão',
        'kilometres' => 'Quilometragem',
        'price' => 'Preço',
        'name' => 'Nome',
        'type' => 'Tipo',
    ),

);
