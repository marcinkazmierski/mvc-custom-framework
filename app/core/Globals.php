<?php

function __autoload($class_name)
{
    $class_name = \app\core\Core::dirNameFilter($class_name);

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if (file_exists($class)) {
        require_once APP_ROOT . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    }
}

/**
 * Global functions:
 *
 *
 * Return translated text.
 */
function t($string)
{
    // TODO: add translate function
    return htmlspecialchars($string);
}

/**
 * Set flash message into session.
 */
function set_flash_message($message)
{
    if (empty($_SESSION['flash_message']) || !is_array($_SESSION['flash_message'])) {
        $_SESSION['flash_message'] = array();
    }
    $_SESSION['flash_message'][] = $message;
}

/**
 * Return HTML with all flash messages.
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