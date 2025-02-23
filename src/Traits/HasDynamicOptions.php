<?php

namespace EsferaMedica\DynamicSelect\Traits;

use Closure;

trait HasDynamicOptions
{
    protected $options = [];

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions($parameters = [])
    {
        $options = $this->options instanceof Closure
            ? call_user_func($this->options, $parameters)
            : $this->options;

        $result = [];
        foreach ($options as $key => $option) {
            $result[] = [
                'value' => $option->id,
                'label' => $option->name,
            ];
        }

        return $result;
    }
}
