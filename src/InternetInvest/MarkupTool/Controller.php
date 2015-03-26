<?php

namespace InternetInvest\MarkupTool;

use Symfony\Component\HttpFoundation\Request;

class Controller 
{
    public function index(Application $app, Request $request)
    {
//        return 123;
//        var_dump();
        $template_file = $app->getRoutes()->get($request->get('_route'))->getOption('template');
        $template_data = $app->getRoutes()->get($request->get('_route'))->getOption('data');
//        var_dump($template_file, $template_data);


        return $app->getTwig()->render($template_file, $template_data);
    }
} 