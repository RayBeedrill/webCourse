<?php
namespace application\api\orders;
use application\core as core;

class Orders extends core\View
{
    public function getOrders($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postOrders($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putOrders($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteOrders($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

