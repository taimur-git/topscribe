<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit274e754f7692d2524f902f50e69ffbdd
{
    public static $files = array (
        '077c46ea4b0fe94d4bac6ac6d1c848fe' => __DIR__ . '/..' . '/copyleaks/php-plagiarism-checker/autoload.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'thiagoalessio\\TesseractOCR\\' => 27,
        ),
        'c' => 
        array (
            'cebe\\markdown\\latex\\' => 20,
            'cebe\\markdown\\' => 14,
        ),
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
        ),
        'L' => 
        array (
            'Laminas\\Escaper\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'thiagoalessio\\TesseractOCR\\' => 
        array (
            0 => __DIR__ . '/..' . '/thiagoalessio/tesseract_ocr/src',
        ),
        'cebe\\markdown\\latex\\' => 
        array (
            0 => __DIR__ . '/..' . '/cebe/markdown-latex',
        ),
        'cebe\\markdown\\' => 
        array (
            0 => __DIR__ . '/..' . '/cebe/markdown',
        ),
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'Laminas\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-escaper/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'MikeVanRiel' => 
            array (
                0 => __DIR__ . '/..' . '/mikevanriel/text-to-latex/src',
                1 => __DIR__ . '/..' . '/mikevanriel/text-to-latex/tests/unit',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit274e754f7692d2524f902f50e69ffbdd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit274e754f7692d2524f902f50e69ffbdd::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit274e754f7692d2524f902f50e69ffbdd::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit274e754f7692d2524f902f50e69ffbdd::$classMap;

        }, null, ClassLoader::class);
    }
}
