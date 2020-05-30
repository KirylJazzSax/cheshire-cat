<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4f4b072e0b108b455fb937bb250b6f0a
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4f4b072e0b108b455fb937bb250b6f0a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4f4b072e0b108b455fb937bb250b6f0a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}