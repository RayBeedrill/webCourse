<?php
namespace application\api\users;
use application\core as core;

class Users extends core\View
{
    public function getUsers($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postUsers($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putUsers($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteUsers($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

