<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 上午11:44
 */

namespace KpUser;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;


class Module implements ConfigProviderInterface,
    AutoloaderProviderInterface,
    ControllerProviderInterface,
    DependencyIndicatorInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getModuleDependencies(){
        return array(
            'KpBase'
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getControllerConfig()
    {
        return array(
            'invokables' => array(
                'KpUser\Controller\User' => 'KpUser\Controller\UserController'
            )
        );
    }

    public function init(ModuleManager $moduleManager)
    {

    }

    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $target = $mvcEvent->getTarget();
        $eventManager = $target->getEventManager();
        $eventManager->getSharedManager()->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) {
            $controller = $e->getTarget();
            $controller->layout('KpUser/Layout');
        }, 2);


    }

}