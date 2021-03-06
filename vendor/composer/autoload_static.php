<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita416f6301b79a9588e56c637e27238e9
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
        'L' => 
        array (
            'LZCompressor\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
        ),
        'LZCompressor\\' => 
        array (
            0 => __DIR__ . '/..' . '/nullpunkt/lz-string-php/src/LZCompressor',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita416f6301b79a9588e56c637e27238e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita416f6301b79a9588e56c637e27238e9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
