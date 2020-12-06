<?php
declare(strict_types=1);

namespace Framework\Service\Profiler;

use Framework\Core\Config;

class Profiler implements ProfilerInterface
{
    const FIELD_START = 'start';
    const FIELD_END = 'end';
    const FIELD_DIFF = 'diff';

    protected $data = [];

    /**
     * @param string $key
     */
    public function start(string $key): void
    {
        $this->data[$key] = [
            self::FIELD_START => microtime(true)
        ];
    }

    /**
     * @param string $key
     */
    public function end(string $key): void
    {
        $this->data[$key][self::FIELD_END] = microtime(true);
        // diff:
        $this->data[$key][self::FIELD_DIFF] = $this->data[$key][self::FIELD_END] - $this->data[$key][self::FIELD_START] ?? 0;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        // todo: template
        $html = '<div class="profiler-wrapper">';
        foreach ($this->data as $name => $data) {
            $html .= '<p>';
            $html .= '[' . $name . '] time exec: ' . ($data[self::FIELD_DIFF] * 1000) . ' ms'; //TODO: log into file
            $html .= '</p>';
        }
        $html .= '</div>';
        return $html;
    }
}