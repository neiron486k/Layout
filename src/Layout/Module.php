<?php
namespace Layout;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Layout
 */
class Module implements BootstrapListenerInterface
{
    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function($e) {
            $result = $e->getResult();
            $result->setTerminal(true);
        });

        $eventManager->getSharedManager()->attach(
                'Zend\Mvc\Controller\AbstractActionController',
                'dispatch',
                function($e) {
                    $controller      = $e->getTarget();
                    $controllerClass = get_class($controller);
                    $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
                    $config          = $e->getApplication()->getServiceManager()->get('config');

                    if (isset($config['module_layouts'][$moduleNamespace])) {
                        $controller->layout($config['module_layouts'][$moduleNamespace]);
                }
            },100);
    }
}
