<?php
namespace application\api\events;
use application\core as core;

class Events extends core\View
{
    public function getEvents($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function postEvents($input = '', $data = '')
    {
        $this->restResponse('200');
        $this->formatOutput($input, $data);
    }

    public function putEvents($input = '', $data = '')
    {
      $this->restResponse('200');
      $this->formatOutput($input, $data);

    }

    public function deleteEvents($input = '', $data = '')
    {
      $this->restResponse('200');
      $this->formatOutput($input, $data);
    }
}

