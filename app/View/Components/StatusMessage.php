<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\Console\Application as ConsoleApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Session\SessionManager;
use Illuminate\View\Component;

final class StatusMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        /**
         * Status type.
         */
        public ?string $type = null,
        /**
         * Status message.
         */
        public ?string $message = null,
        /**
         * Message title.
         */
        public ?string $title = null,
        /**
         * Icon class.
         */
        public ?string $iconClass = null,
        /**
         * Alert component class.
         */
        public ?string $alertClass = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): string|ConsoleApplication|FoundationApplication|View|Factory
    {
        $this->message = $this->message ?: $this->extractMessageFromSession();

        if ($this->message) {
            $this->type = $this->type ?: $this->extractTypeFromSession();

            $this->alertClass = $this->getAlertClass();

            $this->iconClass = $this->getIconClass();

            $this->title = $this->title ?: $this->getDefaultTitle();

            return view('components.status-message');
        }

        return '';
    }

    /**
     * Application session instance.
     */
    public function session(): SessionManager
    {
        return app('session');
    }

    /**
     * Extracts alert type from session (if available).
     */
    public function extractTypeFromSession(): ?string
    {
        if ( ! $this->session()->has('status')) {
            return null;
        }

        return (string) $this->session()->get('status.type');
    }

    /**
     * Extracts message from session (if available).
     */
    public function extractMessageFromSession(): ?string
    {
        if ( ! $this->session()->has('status')) {
            return null;
        }

        return (string) $this->session()->get('status.message');
    }

    /**
     * Returns the alert class name.
     */
    public function getAlertClass(): string
    {
        return match ($this->type) {
            'info', 'information' => 'alert-info',
            'warn', 'warning' => 'alert-warning',
            'danger', 'error', 'critical', 'failure', 'fail' => 'alert-danger',
            'success', 'ok' => 'alert-success',
            default => 'alert-' . $this->type,
        };
    }

    /**
     * Returns the alert icon class/type.
     */
    public function getIconClass(): ?string
    {
        $iconClass = trim((string) $this->iconClass);

        if ('' !== $iconClass) {
            return $iconClass;
        }

        return match ($this->type) {
            'info', 'information' => 'info',
            'warn', 'warning' => 'alert-warning',
            'danger', 'error', 'critical', 'failure', 'fail' => 'alert-circle',
            'success', 'ok' => 'check',
            default => null,
        };
    }

    /**
     * Returns the alert default title.
     */
    public function getDefaultTitle(): ?string
    {
        return match ($this->type) {
            'info', 'information' => 'You know?',
            'warn', 'warning' => 'Something went wrong',
            'danger', 'error', 'critical', 'failure', 'fail' => 'Error',
            'success', 'ok' => 'Success',
            default => null,
        };
    }
}
