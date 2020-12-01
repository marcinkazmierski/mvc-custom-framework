<?php
declare(strict_types=1);

namespace Framework\Exception;


use Framework\Core\Controller;

class ExceptionController extends Controller
{
    public function render(\Exception $exception)
    {
        return $this->renderView("exception", $exception->getMessage(), null, false, 500);
    }
}