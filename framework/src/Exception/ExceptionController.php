<?php
declare(strict_types=1);

namespace Exception;


use Core\Controller;

class ExceptionController extends Controller
{
    public function render(\Exception $exception)
    {
        return $this->renderView("exception", $exception->getMessage(), null, false, 500);
    }
}