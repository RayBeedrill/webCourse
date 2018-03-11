<?php
namespace application\api\status;
use application\core as core;

class Status extends core\View
{
    public function getStatus($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postStatus($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putStatus($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteStatus($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

