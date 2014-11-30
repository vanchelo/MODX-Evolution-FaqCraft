<?php namespace FaqCraft;

require __DIR__ . '/functions.php';

spl_autoload_register(function($class) {
    if (strpos($class, 'FaqCraft\\') === 0) {
        $name = substr($class, strlen('FaqCraft'));
        require __DIR__ . '/FaqCraft' . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});
