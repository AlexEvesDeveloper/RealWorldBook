<?php

namespace RealWorldBook\Chapter2\View;

class ErrorView extends View
{
    protected $errorMessage;

    /**
     * ErrorView constructor.
     * @param $errorMessage
     */
    public function __construct($viewScript, $errorMessage)
    {
        $this->errorMessage = $errorMessage;
        parent::__construct($viewScript);
    }
}