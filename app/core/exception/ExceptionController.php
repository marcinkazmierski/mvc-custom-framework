<?php

namespace app\core\exception;

use app\core\Controller;

class ExceptionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render(\Exception $exception)
    {
        $status = ($exception->getCode() > 0) ? $exception->getCode() : 500;
        return $this->renderView("exception", $exception->getMessage(), null, false, $status);
    }
}