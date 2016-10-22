<?php
namespace app\core;

use app\config\Config;
use app\core\interfaces\IProfiler;

class Profiler implements IProfiler
{
    private $data;
    private $environment;

    private static $instance = null;

    private function __construct()
    {
        $this->environment = Config::getOption('environment');
        if (empty($this->environment)) {
            $this->environment = 'prod';
        }
        $this->data = array();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Profiler();
        }
        return self::$instance;
    }

    public function isEnabled()
    {
        if ($this->environment === 'dev') {
            return true;
        }
        return false;
    }

    public function start($name)
    {
        if (!$this->isEnabled()) {
            return false;
        }
        $this->data[$name] = array(
            'start' => microtime(true)
        );
        return true;
    }

    public function end($name)
    {
        if (!$this->isEnabled()) {
            return false;
        }

        if (empty($this->data[$name]['start'])) {
            $this->start($name);
        }
        $this->data[$name]['end'] = microtime(true);
        // seconds
        $this->data[$name]['diff'] = $this->data[$name]['end'] - $this->data[$name]['start'];
        return true;
    }

    public function getAllStats()
    {
        if (!$this->isEnabled()) {
            return false;
        }
        $html = '<div class="profiler-wrapper">';
        foreach ($this->data as $name => $data) {
            $html .= '<p>';
            $html .= '[' . $name . '] time exec: ' . ($data['diff'] * 1000) . ' ms'; //TODO: log into file?
            $html .= '</p>';
        }
        $html .= '</div>';
        return $html;
    }
}