# Markup Tool

Сначала надо в корне проекта создать файл `composer.json` с следующим кодом:

```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/imena/markup-tool"
        }
    ],
    "require": {
        "imena/markup-tool": "dev-master"
    }
}
```

В корне нужно создать два файла. Первый файл `index.php`


```
<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/vendor/autoload.php';

$app = new \InternetInvest\MarkupTool\Application();
$app->run();
```

и второй `.htaccess`

```
<IfModule mod_rewrite.c>
    Options -MultiViews

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>
```

Для вёрстки нужно создать папку `views`. Это название стандартное.