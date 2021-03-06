<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf8cbc57c7fa5bb5716c75b3c9362367
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf8cbc57c7fa5bb5716c75b3c9362367::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf8cbc57c7fa5bb5716c75b3c9362367::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
