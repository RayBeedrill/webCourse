<?php
namespace application\api\filters;
use application\core as core;

class Filters extends core\View
{
    public function getFilters($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postFilters($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function putFilters($input = '', $data = '')
    {
        $this->restResponse($data);
    }

    public function deleteFilters($input = '', $data = '')
    {
        $this->restResponse($data);
    }
}

