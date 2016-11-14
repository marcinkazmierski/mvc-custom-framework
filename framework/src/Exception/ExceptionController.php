<?php
declare(strict_types=1);

namespace Exception;


use Core\Controller;

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