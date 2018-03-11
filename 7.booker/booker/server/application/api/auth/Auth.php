<?php
namespace application\api\auth;
use application\core as core;

class Auth extends core\View
{
    public function getAuth($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postAuth($input = '', $data = '')
    {
      $this->restResponse('200');
      $this->formatOutput($input, $data);
    }

    public function putAuth($input = '', $data = '')
    {
      $this->restResponse('200');
      $this->formatOutput($input, $data);
    }

    public function deleteAuth($input = '', $data = '')
    {
      $this->restResponse('200');
      $this->formatOutput($input, $data);
    }
}

