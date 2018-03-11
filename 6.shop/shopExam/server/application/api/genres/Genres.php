<?php
namespace application\api\genres;
use application\core as core;

class Genres extends core\View
{
    public function getGenres($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postGenres($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putGenres($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteGenres($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

