<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午12:03
 */

namespace KpUser\Controller;

use KpUser\Event\UserEvent;
use KpUser\Form\UserRegForm;
use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{

    public function regAction()
    {
        $form = new UserRegForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $postParameters = $request->getPost();
            $form->setData($postParameters);
            if ($form->isValid()) {

                $formUserEntity = $form->getData();

                $eventManager = $this->getEventManager();
                $userEvent = new UserEvent();
                $userEvent->setUserEntity($formUserEntity)->setForm($form);

                $responseCollection = $eventManager->trigger(UserEvent::USER_REG_PRE, $this, $userEvent);

                if ($responseCollection->last() !== false) {

                    $userTable = $this->getServiceLocator()->get('KpUser\Model\UserTable');

                    if ($id = $userTable->save($formUserEntity)) {
                        $userEvent->getUserEntity()->setId($id);
                        $eventManager->trigger(UserEvent::USER_REG_POST, $this, $userEvent);

                        return $this->redirect()->toRoute('KpUser-login');
                    }

                    $eventManager->trigger(UserEvent::USER_REG_ERROR, $this, $userEvent);
                }
            }
        }

        return array(
            'form' => $form
        );
    }

    public function loginAction()
    {

    }
}
