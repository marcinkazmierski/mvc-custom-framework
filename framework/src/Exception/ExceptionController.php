<?php
declare(strict_types=1);

namespace Framework\Exception;

use Framework\Core\Controller;

class ExceptionController extends Controller
{
    /**
     * @param \Throwable $exception
     * @return \Framework\Response\Response
     * @throws RuntimeException
     */
    public function render(\Throwable $exception)
    {
        $message = $this->getEnvironment() === 'prod' ? t("Fatal error!") : $exception->getMessage();
        return $this->renderView("exception", ["message" => $message], null, false, 500);
    }
}