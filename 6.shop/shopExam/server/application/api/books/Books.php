<?php
namespace application\api\books;
use application\core as core;

class Books extends core\View
{
    public function getBooks($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postBooks($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putBooks($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteBooks($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

