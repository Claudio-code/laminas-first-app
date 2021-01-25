<?php

use Core\Factories\TransportSmtpFactory;
use Core\Factories\FormElementFactory;
use Laminas\Form\View\Helper\FormElementErrors;

return [
  'service_manager' => [
    'factories' => [
      'core.transport.smtp' => TransportSmtpFactory::class
    ]
    ],
    'view_helpers' => [
      'factories' => [
        FormElementErrors::class => FormElementErrors::class
      ]
    ]
];