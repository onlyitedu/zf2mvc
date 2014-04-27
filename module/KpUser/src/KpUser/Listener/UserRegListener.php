<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 下午1:22
 */

namespace KpUser\Listener;

use KpUser\Event\UserEvent;
use KpUser\Exception\InvalidArgumentException;
use KpUser\Model\UserModel;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\Controller\AbstractController;

class UserRegListener implements ListenerAggregateInterface
{
    protected $banUsername = array(
        'caonimabi', 'xijinping', 'admin'
    );

    public function attach(EventManagerInterface $events)
    {
        $events->getSharedManager()->attach('*', UserEvent::USER_REG_PRE, array($this, 'checkUsername'), 10000);
        $events->getSharedManager()->attach('*', UserEvent::USER_REG_PRE, array($this, 'setRegdate'));
        $events->getSharedManager()->attach('*', UserEvent::USER_REG_PRE, array($this, 'setType'));
        $events->getSharedManager()->attach('*', UserEvent::USER_REG_PRE, array($this, 'setStatus'));
        $events->getSharedManager()->attach('*', UserEvent::USER_REG_PRE, array($this, 'setRegip'));
        $events->getSharedManager()->attach('*', UserEvent::USER_REG_ERROR, array($this, 'setSaveError'));
    }


    public function detach(EventManagerInterface $events)
    {

    }


    public function checkUsername(EventInterface $e)
    {

        $userEntity = $e->getUserEntity();

        if (in_array($userEntity->getUsername(), $this->banUsername)) {
            $e->stopPropagation(true);
            $element = $e->getForm()->get('username');
            $messages = $element->getMessages();
            $messages[] = '禁止使用该用户名';
            $element->setMessages($messages);
            return false;
        }

    }

    public function setRegdate(EventInterface $e)
    {
        $userEntity = $e->getUserEntity();

        $userEntity->setRegdate(time());

    }

    public function setStatus(EventInterface $e)
    {
        $userEntity = $e->getUserEntity();

        $userEntity->setStatus(UserModel::DEFAULT_STATUS);

    }

    public function setType(EventInterface $e)
    {
        $userEntity = $e->getUserEntity();

        $userEntity->setType(UserModel::DEFAULT_TYPE);

    }

    public function setRegip(EventInterface $e)
    {
        $controller = $e->getTarget();

        if (!$controller instanceof AbstractController) {
            throw new InvalidArgumentException('$controller 必须是  Zend\Mvc\Controller\AbstractController');
        }

        $ip = $controller->getRequest()->getServer()->get('REMOTE_ADDR');

        $userEntity = $e->getUserEntity();

        $userEntity->setRegip($ip);
    }

    public function setSaveError(EventInterface $e)
    {
        $element = $e->getForm()->get('username');
        $messages = $element->getMessages();
        $messages[] = '注册失败，请重新注册';
        $element->setMessages($messages);
    }
}