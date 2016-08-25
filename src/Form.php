<?php

namespace AdminLTE_Twig_Tpl;

class Form extends \ArrayObject
{
    private $fields = [];
    private $allowFieldTypes = ['text', 'password'];

    public function __construct()
    {
        $this->buildForm();
    }

    public function buildForm()
    {
    }

    public function add($name, $type, array $options = [])
    {
        if (!$this->isAllowFieldType($type))
        {
            throw new \UnexpectedValueException(sprintf('Field type "%s" is not allowed field tpes', $type));
        }

        $this->fields[$name] = [
            'name' => $name,
            'type' => $type,
        ];

        $this->fields[$name] += $options;
    }

    public function offsetGet($name)
    {
        return isset($this->fields[$name]) ? $this->fields[$name] : null;
    }

    public function offsetSet($name, $value)
    {
        throw new \BadMethodCallException('Not supported');
    }

    public function offsetUnset($name)
    {
        unset($this->fields[$name]);
    }

    public function offsetExists($name)
    {
        return isset($this->fields[$name]);
    }

    public function handleRequest()
    {
    }

    public function isSubmitted()
    {
        return true;
    }

    private function isAllowFieldType($type)
    {
        return in_array($type, $this->allowFieldTypes);
    }
}
