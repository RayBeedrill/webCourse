<?php
namespace application\api\payment;
use application\core as core;

class Payment extends core\View
{
    public function getPayment($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postPayment($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putPayment($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deletePayment($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

