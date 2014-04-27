<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-19 下午3:28
 */

namespace Album\Controller;

use Album\Form\AlbumForm;
use Album\Form\AlbumInputFilter;
use Album\Model\Album;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{

    public function indexAction()
    {
        $albumResultSet = $this->getServiceLocator()->get('Album\Model\AlbumTable')->fetchAll();

        $viewModel = new ViewModel();

        $viewModel->setVariables(array(
            'albumResultSet' => $albumResultSet
        ));

        $this->layout('album/layout');
        return $viewModel;
    }

    public function addAction()
    {
        $form = new AlbumForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $parameters = $request->getPost();
            $form->setObject(new Album());
            $form->setData($parameters);
            $form->setInputFilter(new AlbumInputFilter());

            if ($form->isValid()) {
                $this->getServiceLocator()->get('Album\Model\AlbumTable')->save($form->getData());

                return $this->redirect()->toRoute('album');
            }

        }

        return array(
            'form' => $form
        );
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id', null);

        if ($id === null) {
            return $this->redirect()->toRoute('album');
        }

        $albumTable = $this->getServiceLocator()->get('Album\Model\AlbumTable');

        $albumModel = $albumTable->getAlbum($id);

        if (!$albumModel) {
            return $this->redirect()->toRoute('album');
        }

        $form = new AlbumForm();
        $form->bind($albumModel);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $postParameters = $request->getPost();
            $form->setData($postParameters);
            $form->setInputFilter(new AlbumInputFilter());
            if ($form->isValid()) {

                $formAlbumModel = $form->getData();
                $albumTable->save($formAlbumModel);
                return $this->redirect()->toRoute('album');

            }
        }

        return array(
            'form' => $form
        );


    }

    public function delAction()
    {

        // Zend\Mvc\Controller\Plugin\Params
        $id = $this->params()->fromRoute('id', null);

        $request = $this->getRequest();

        if ($request->isPost()) {

            if ($request->getPost('del') === 'Yes') {

                if ($id !== null) {
                    $this->getServiceLocator()->get('Album\Model\AlbumTable')->deleteAlbum($id);
                }
            }

            $id = null;

        }

        if ($id === null) {
            return $this->redirect()->toRoute('album');
        }

        return array(
            'album' => $this->getServiceLocator()->get('Album\Model\AlbumTable')->getAlbum($id)
        );
    }
}