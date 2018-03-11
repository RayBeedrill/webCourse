<?php
namespace application\api\rooms;
use application\core as core;

class Rooms extends core\View
{
    public function getRooms($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postRooms($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putRooms($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteRooms($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

