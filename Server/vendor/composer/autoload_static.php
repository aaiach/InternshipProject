<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc350e1a1d1c6542bb9c26d6c3ed0daad
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc350e1a1d1c6542bb9c26d6c3ed0daad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc350e1a1d1c6542bb9c26d6c3ed0daad::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
