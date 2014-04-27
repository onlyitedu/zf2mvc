<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午12:03
 */

namespace KpUser\Controller;

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
                $userTable = $this->getServiceLocator()->get('KpUser\Model\UserTable');
                $userTable->save($formUserEntity);
              
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
