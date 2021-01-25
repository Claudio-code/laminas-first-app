<?php

namespace Core\Factories;

use Interop\Container\ContainerInterface;
use Laminas\Form\View\Helper\FormElementErrors;
use Laminas\ServiceManager\Factory\FactoryInterface;

class FormElementFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): FormElementErrors
    {
        $helper = new FormElementErrors();
        $config = $container->get('config');

        if (!isset($config['view_helper_config']['form_element_errors'])) {
            return $helper;
        }

        $configHelper = $config['view_helper_config']['form_element_errors'];
        if (isset($configHelper['message_open_format'])) {
            $helper->setMessageOpenFormat($configHelper['message_open_format']);
        }

        if (isset($configHelper['message_separator_string'])) {
            $helper->setMessageSeparatorString($configHelper['message_separator_string']);
        }

        if (isset($configHelper['message_close_string'])) {
            $helper->setMessageSeparatorString($configHelper['message_close_string']);
        }

        return $helper;
    }
}