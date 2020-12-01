<?php
declare(strict_types = 1);

spl_autoload_register('MVCAutoLoader');
function MVCAutoLoader($class_name)
{
    $className =  \Framework\Core\Core::dirNameFilter($class_name);

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $fileClass = FRAMEWORK_SRC_PATH . $class;

    if (file_exists($fileClass)) {
        require_once $fileClass;
    } else {
        $fileClass = APP_SRC_PATH . $class;
        if (file_exists($fileClass)) {
            require_once $fileClass;
        }
    }
}

/**
 * Global functions:
 */

/**
 * Return translated text.
 *
 * @param $string
 * @return string
 */
function t($string)
{
    // TODO: add translate function
    return htmlspecialchars($string);
}

/**
 * Set flash message into session.
 *
 * @param string $message
 */
function set_flash_message(string $message)
{
    if (empty($_SESSION['flash_message']) || !is_array($_SESSION['flash_message'])) {
        $_SESSION['flash_message'] = array();
    }
    $_SESSION['flash_message'][] = $message;
}

/**
 *  Return HTML with all flash messages.
 * @return string
 */
function get_all_flash_messages()
{
    $flash_messages = '';
    if (isset($_SESSION['flash_message']) && is_array($_SESSION['flash_message']) && count($_SESSION['flash_message']) > 0) {
        $flash_messages .= '<div class="flash-messages alert alert-info">';
        $flash_messages .= '<ul>';
        foreach ($_SESSION['flash_message'] as $flash) {
            $flash_messages .= '<li>' . $flash . '</li>';
        }
        $_SESSION['flash_message'] = NULL;
        $flash_messages .= '</ul>';
        $flash_messages .= '</div>';
    }
    return $flash_messages;
}