<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Captcha middleware
    |--------------------------------------------------------------------------
    |
    */
    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Captcha routes
    |--------------------------------------------------------------------------
    |
    */
    'routes' => [
        'image'     => 'captcha/image',
        'image_tag' => 'captcha/image_tag'
    ],

    /*
    |--------------------------------------------------------------------------
    | Blade directive
    |--------------------------------------------------------------------------
    | You can use blade directive @captcha for rendering captcha.
    |
    */
    'blade' => 'captcha',

    /*
    |--------------------------------------------------------------------------
    | Validator name
    |--------------------------------------------------------------------------
    |
    */
    'validator' => 'captcha',

    /*
    |--------------------------------------------------------------------------
    | Captcha generator.
    |--------------------------------------------------------------------------
    | Must implement GeneratorInterface.
    |
    */
    'generator' => \Igoshev\Captcha\Captcha\Generator\GeneratorWaves::class,

    /*
    |--------------------------------------------------------------------------
    | Storage code.
    |--------------------------------------------------------------------------
    | Must implement StorageInterface.
    |
    */
    'storage' => \Igoshev\Captcha\Captcha\Storage\SessionStorage::class,

    /*
    |--------------------------------------------------------------------------
    | Code generator.
    |--------------------------------------------------------------------------
    | Must implement CodeInterface.
    |
    */
    'code' => \Igoshev\Captcha\Captcha\Code\SimpleCode::class,

    /*
    |--------------------------------------------------------------------------
    | Font
    |--------------------------------------------------------------------------
    | Supported: "IndiraK".
    |
    */
    'font' => base_path('vendor/bonecms/laravel-captcha/src/resources/fonts/IndiraK.ttf'),

    /*
    |--------------------------------------------------------------------------
    | Font size
    |--------------------------------------------------------------------------
    | Font size in pixels.
    |
    */
    'fontSize' => 24,

    /*
    |--------------------------------------------------------------------------
    | Letter spacing
    |--------------------------------------------------------------------------
    | Spacing between letters in pixels.
    |
    */
    'letterSpacing' => 4,

    /*
    |--------------------------------------------------------------------------
    | Code Length
    |--------------------------------------------------------------------------
    | You can specify an array or integer.
    |
    */
    'length' => [4, 5],

    /*
    |--------------------------------------------------------------------------
    | Displayed chars
    |--------------------------------------------------------------------------
    | Enter the different characters.
    |
    */
    'chars' => 'QSFHTRPAJKLMZXCVBNabdefhxktyzj23456789',

    /*
    |--------------------------------------------------------------------------
    | Image Size
    |--------------------------------------------------------------------------
    | Captcha image size can be controlled by setting the width
    | and height properties.
    |
    |
    */
    'width'  => 100,
    'height' => 40,

    /*
    |--------------------------------------------------------------------------
    | Background Captcha
    |--------------------------------------------------------------------------
    | You can specify an array or string.
    |
    */
//    'background' => '002646FF',
    'background' => 'E6E9EEFF',

    /*
    |--------------------------------------------------------------------------
    | Colors characters
    |--------------------------------------------------------------------------
    | You can specify an array or string.
    |
    */
    'colors' => '2980b9',

    /*
    |--------------------------------------------------------------------------
    | Scratches
    |--------------------------------------------------------------------------
    | The number of scratches displayed in the Captcha.
    |
    */
    'scratches' => [1, 6],

    /*
    |--------------------------------------------------------------------------
    | Id of the Captcha code input textbox
    |--------------------------------------------------------------------------
    | After updating the Captcha focus will be set on an element with this id.
    |
    */
    'inputId' => 'captcha',

];
