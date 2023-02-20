<?php declare(strict_types=1);

    $finder = PhpCsFixer\Finder::create()
        // チェックするディレクトリの指定
        ->in([
            '/var/www/html/app',
            '/var/www/html/config',
            '/var/www/html/database/factories',
            '/var/www/html/database/seeders',
            '/var/www/html/routes',
            '/var/www/html/packages',
            '/var/www/html/tests',
        ]);

    $config = new PhpCsFixer\Config();

    return $config
        ->setRiskyAllowed(true)
        ->setRules([
            '@PSR1' => true,
            '@PSR2' => true,
        ])
        ->setFinder($finder);
