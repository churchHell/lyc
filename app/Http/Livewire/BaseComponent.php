<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{

    protected function query(callable $function)
    {
        try {
            return $function();
        } catch (\Exception $e) {
            $this->emitException($e->getMessage());
            return;
        }
    }

    protected function resultIcon($condition, string $success = 'success', string $error = 'error'): bool
    {
        $this->emit((bool)$condition ? $success : $error);
        return (bool)$condition;
    }

    protected function queryWithResult(callable $function): ?bool
    {
        $result = $this->query($function);
        $this->result($result);
        return $result;
    }

    protected function result($condition): void
    {
        (bool)$condition ? $this->emitSuccess() : $this->emitError();
    }

    public function emitSuccess(string $message = null): void
    {
        $this->emitTo('toasts', 'success', $message);
    }

    public function emitError(string $message = ''): void
    {
        $this->emitTo('toasts', 'error', $message);
    }

    public function emitWarning(string $message = ''): void
    {
        $this->emitTo('toasts', 'warning', $message);
    }

    public function emitException(string $message): void
    {
        $this->emitTo('toasts', 'exception', $message);
    }

    public function sleep()
    {
        sleep(3);
    }
}
