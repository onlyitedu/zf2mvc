<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午12:03
 */

namespace KpUser\Controller;

use KpUser\Form\UserRegForm;
use KpUser\InputFilter\UserRegInputFilter;
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
            $form->setInputFilter(new UserRegInputFilter());
            if ($form->isValid()) {

                var_dump($form->getData());
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
