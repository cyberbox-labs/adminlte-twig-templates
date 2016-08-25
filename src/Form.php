<?php

namespace AdminLTE_Twig_Tpl;

class Form extends \ArrayObject
{
    private $twig;
    private $tplNamespace;
    private $fields = [];
    private $allowFieldTypes = ['text', 'password'];

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;

        $globals = $twig->getGlobals();
        if (!isset($globals['tpl_namespace']))
        {
            throw new \RuntimeException('Twig global variable "tpl_namespace" is not set');
        }

        $this->tplNamespace = $globals['tpl_namespace'];
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

    // public function row($name, array $variables = [])
    // {
    //     echo $this->renderBlock('block/form_row.html.twig', $variables);
    // }

    private function isAllowFieldType($type)
    {
        return in_array($type, $this->allowFieldTypes);
    }

    // private function renderBlock($name, array $data = [])
    // {
    //     $name = sprintf('@%s/%s', $this->tplNamespace, $name);
    //     $template = $this->twig->loadTemplate($name);

    //     return $template->render(['hello' => 'world']);
    // }

    // public function __call($name)
    // {
    //     if (isset($this->fields[$name]))
    //     {
    //         return $this->fields[$name];
    //     }
    // }

    public function Repository()
    {
        return 1;
    }
}
