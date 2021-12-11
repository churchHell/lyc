<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImagesUpload extends Component
{

    use WithFileUploads;

    public $images = [];
    public string $path = '';

    protected array $rules = ['images.*' => ['image']];

    public function upload(): void
    {
        $images = collect($this->images)->map(
            fn($image) => $image = Image::create([
                'path' => $image->store($this->path)
            ])
        );
        $this->images = [];
        $this->emit('imagesUploaded', $images->pluck('id'));
    }

    public function delete(int $id): void
    {
        unset($this->images[$id]);
    }

    public function render()
    {
        return view('livewire.admin.images-upload');
    }
}
