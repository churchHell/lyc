<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Http\Livewire\BaseComponent;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends BaseComponent
{

    use AuthorizesRequests;

    public array $settings = [];

    public function mount(): void
    {
        $settings = Setting::with('type')->get()->keyBy('id')->toArray();
        $this->settings = $settings;
    }

    public function update(int $id): void
    {
        $setting = Setting::findOrFail($id);
        $this->authorize('update', $setting);
        $validated = $this->validateAll($id);
        $this->getErrorBag();

        // $this->result($setting->update(['value']))
        dd($validated);

        $this->result($setting->update());
    }

    private function validateAll(int $id): array
    {
        $type = $this->settings[$id]['type']['slug'];
        switch($type) {
            case 'bool': $rules = ['boolean']; break;
            case 'text': $rules = ['integer']; break;
            case 'int': $rules = ['integer', 'min:0']; break;
            default: $rules = ['string'];
        }
        // dd(1, $this->validate(['settings.'.$id.'.value' => $rules]));
        return $this->validate(['settings.'.$id.'.value' => $rules]);
    }

    public function render()
    {
        $settings = Setting::get();
        return view('livewire.admin.settings.index', compact('settings'));
    }
}
