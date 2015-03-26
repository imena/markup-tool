<?php

namespace InternetInvest\MarkupTool;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Application extends \Silex\Application 
{
    public function __construct()
    {
        parent::__construct();
        
        // включаем дебаг
        $this['debug'] = true;
        
        // подключаем твиг
        $this->register(new TwigServiceProvider(), array(
            'twig.path' => getcwd() . '/views',
            'twig.options' => array(
//        "cache" => __DIR__ . '/tmp',
            ),
        ));

        // подключаем генерацию ссылок
        $this->register(new UrlGeneratorServiceProvider());
        
        // конфигурируем проект
        $jsonDecoder = new JsonDecode(true);
        $config = $jsonDecoder->decode(file_get_contents('config.json'), JsonEncoder::FORMAT);

//        $loader = new \Twig_Loader_Filesystem();
        $routesCollection = new RouteCollection();

        foreach ($config['routes'] as $route_config) {
//            var_dump($route_config); exit;
            $route = new Route($route_config['route'], array('_controller' => 'InternetInvest\\MarkupTool\\Controller::index'));
//            $route->setMethods($route_config['method']);

            $route->setOption('template', $route_config['template']);
            $route->setOption('data', $route_config['data']);
            $routesCollection->add($route_config['name'], $route);
        }

        $this->getRoutes()->addCollection($routesCollection);
        

//        /** @var \Twig_Loader_Chain $twigLoaderChain */
//        $twigLoaderChain = $this->getTwig()->getLoader();
//        $twigLoaderChain->addLoader($loader);
    }
    
    /**
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this['routes'];
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this['twig'];
    }

    /**
     * @return \Symfony\Component\Form\FormFactoryInterface
     */
    public function getFormFactory()
    {
        return $this['form.factory'];
    }
} 