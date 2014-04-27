<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 下午1:13
 */

namespace KpUser\Event;

use KpUser\Entity\UserEntity;
use Zend\EventManager\Event;
use Zend\Form\FormInterface;

class UserEvent extends Event
{
    const USER_REG_PRE = 'user.reg.pre';
    const USER_REG_POST = 'user.reg.post';
    const USER_REG_ERROR = 'user.reg.error';

    public function getUserEntity(){
        return $this->getParam('userEntity');
    }

    public function setUserEntity(UserEntity $userEntity){
        $this->setParam('userEntity',$userEntity);
        return $this;
    }

    public function setForm(FormInterface $form){
        $this->setParam('form',$form);
        return $this;
    }

    public function getForm(){
        return $this->getParam('form');
    }
}