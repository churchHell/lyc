<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toasts extends Component
{

    public array $toasts = ['error' => [], 'success' => [], 'warning' => []];

    protected $listeners = ['loading', 'success', 'error', 'exception', 'warning'];

    public function loading(): void
    {
        $this->toastWarning(__('loading'));
    }

    public function success(string $message = null): void
    {
        $this->toasts['success'][] = $message ?? __('success');
    }

    public function exception(string $message = ''): void
    {
        $this->toastError($message);
    }

    public function error(string $message = ''): void
    {
        $this->toastError(__('error') . '. ' . __('try-again'));
    }

    public function warning(string $message): void
    {
        $this->toastWarning($message);
    }

    public function toastError(string $error): void
    {
        $this->toasts['error'][] = $error;
    }

    public function toastWarning(string $warning): void
    {
        $this->toasts['warning'][] = $warning;
    }

    public function removeToast(string $type, int $id): void
    {
        unset($this->toasts[$type][$id]);
    }

    public function render()
    {
        return view('livewire.toasts');
    }
}
