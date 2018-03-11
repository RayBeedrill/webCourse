<?php
namespace application\api\discount;
use application\core as core;

class Discount extends core\View
{
    public function getDiscount($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postDiscount($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putDiscount($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteDiscount($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

