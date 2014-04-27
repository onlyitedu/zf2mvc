<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-20 上午9:26
 */
namespace Album\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class AlbumTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function save(Album $album)
    {
        $id = (int) $album->id;

        $saveData = $album->getArrayCopy();

        if (!$id) {
            return $this->tableGateway->insert($saveData) ? $this->tableGateway->lastInsertValue : false;
        }

        return $this->tableGateway->update($saveData, array('id' => $id));

    }

    public function getAlbum($id)
    {
        return $this->tableGateway->select(array('id' => $id))->current();
    }

    public function fetchAll()
    {
        return $this->tableGateway->select(function (Select $select) {
            $select->order('id desc');
        });

    }

    public function deleteAlbum($id)
    {

        return $this->tableGateway->delete(array('id' => (int)$id));

    }
}