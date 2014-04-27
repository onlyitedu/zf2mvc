<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 上午11:44
 */

namespace KpUser;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;


class Module implements ConfigProviderInterface,
    AutoloaderProviderInterface,
    ControllerProviderInterface
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

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $adapater = $serviceManager->get('Zend\Db\Adapter\Adapter');
            GlobalAdapterFeature::setStaticAdapter($adapater);
        }, 2);

        $translator = $target->getServiceManager()->get('MvcTranslator');
        $translator->addTranslationFile('phpArray', './vendor/zendframework/zendframework/resources/languages/zh/Zend_Validate.php', 'default', 'zh_CN');
        AbstractValidator::setDefaultTranslator($translator);

    }

}