<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Http\Livewire\BaseComponent;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends BaseComponent
{

    use AuthorizesRequests;

    public array $setting;

    protected array $rules = ['setting.value' => 'string'];

    public function mount(Setting $settingModel): void
    {
        $this->setting = $settingModel->toArray();
    }

    public function update(): void
    {
        $setting = Setting::findOrFail($this->setting['id']);
        $this->authorize('update', $setting);
        $validated = $this->validate();

        $this->result($setting->update($validated['setting']));
    }

    public function render()
    {
        return view('livewire.admin.settings.edit');
    }
}
