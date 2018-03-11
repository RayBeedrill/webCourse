<?php
namespace application\api\authors;
use application\core as core;

class Authors extends core\View
{
    public function getAuthors($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postAuthors($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putAuthors($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteAuthors($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

