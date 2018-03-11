<?php
namespace application\api\cart;
use application\core as core;

class Cart extends core\View
{
    public function getCart($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postCart($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putCart($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteCart($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

