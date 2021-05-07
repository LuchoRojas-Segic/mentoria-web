<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9a74d6945a7f7d2cd41ed5008b5e508
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9a74d6945a7f7d2cd41ed5008b5e508::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9a74d6945a7f7d2cd41ed5008b5e508::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc9a74d6945a7f7d2cd41ed5008b5e508::$classMap;

        }, null, ClassLoader::class);
    }
}