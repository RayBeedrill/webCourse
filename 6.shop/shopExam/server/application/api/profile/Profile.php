<?php
namespace application\api\profile;
use application\core as core;

class Profile extends core\View
{
    public function getProfile($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postProfile($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putProfile($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteProfile($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

