<?php

namespace App\Responses;

class ModalResponse
{
    public string $title;
    public string $body;
    public string $closeText;
    public bool $successHide;

    public function __construct()
    {
        $this->title = '';
        $this->body = '';
        $this->closeText = __('Close');
        $this->successHide = false;
    }
}
