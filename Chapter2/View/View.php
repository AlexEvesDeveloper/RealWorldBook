<?php

namespace RealWorldBook\Chapter2\View;

class View
{
    protected $viewScript;

    /**
     * View constructor.
     * @param $viewScript
     */
    public function __construct($viewScript)
    {
        $this->viewScript = $viewScript;
    }
}