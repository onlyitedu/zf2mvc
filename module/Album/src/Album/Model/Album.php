<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-20 上午9:24
 */

namespace Album\Model;

class Album
{
    public $id;
    public $artist;
    public $title;

    public function exchangeArray($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->artist = isset($data['artist']) ? $data['artist'] : null;
        $this->title = isset($data['title']) ? $data['title'] : null;
    }

    public function getArrayCopy(){
        return array(
            'id'=>$this->id,
            'title'=>$this->title,
            'artist'=>$this->artist
        );
    }
}