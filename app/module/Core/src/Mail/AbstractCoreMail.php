<?php

namespace Core\Mail;

use Laminas\View\View;
use Laminas\Mail\Message;
use Laminas\Mime\Part as MimePart;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mail\Transport\Smtp as SmtpTransport;

abstract class AbstractCoreMail
{
    protected SmtpTransport $transport;

    protected View $view;

    protected ?MimeMessage $body;

    protected ?Message $message;

    protected ?string $subject;

    protected ?string $to;

    protected ?string $replyTo;

    protected ?array $data;

    protected ?string $page;

    protected ?string $cc;

    public function __construct(SmtpTransport $transport, View $view, string $page)
    {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }

    public function getTransport(): SmtpTransport
    {
        return $this->transport;
    }

    public function setTransport(SmtpTransport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getView(): View
    {
        return $this->view;
    }

    public function setView(View $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getBody(): MimeMessage
    {
        return $this->body;
    }

    public function setBody(MimeMessage $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function setMessage(Message $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function getReplyTo(): string
    {
        return $this->replyTo;
    }

    public function setReplyTo(string $replyTo): self
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getCc(): string
    {
        return $this->cc;
    }

    public function setCc(string $cc): self
    {
        $this->cc = $cc;

        return $this;
    }

    abstract public function renderView(string $page, array $data);

    public function prepare(): self
    {
        $html = new MimePart($this->renderView($this->page, $this->data));
        $html->type = 'text/html';

        $this->body = new MimeMessage();
        $this->body->setParts([$html]);

        $config = $this->transport->getOptions()->toArray();
        $this->message = new Message();
        $this->message
            ->addFrom($config['connection_config']['from'])
            ->addTo($this->to)
            ->setSubject($this->subject)
            ->setBody($this->body)
        ;

        if ($this->cc) {
            $this->message->addCc($this->cc);
        }

        if ($this->replyTo) {
            $this->message->addReplyTo($this->replyTo);
        }

        return $this;
    }

    public function send(): self
    {
        $this->transport->send($this->message);

        return $this;
    }
}