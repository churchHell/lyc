<?php

namespace App\Http\Livewire\Admin\Items;

use App\Http\Livewire\BaseComponent;
use App\Models\{Category, Image, Item, Property};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;

class Create extends BaseComponent
{

    use AuthorizesRequests;
    use WithFileUploads;

    public string $name = '';

    public array $categories = [];
    public ?int $categoryId = null;

    public $photos = [];

    public array $properties = [];
    public ?int $propertyId = null;
    public ?string $propertyValue = null;

    public string $description = '';

    public $qty;

    public $price;

    public bool $active = true;

    public function addProperty(): void
    {
        $this->properties[] = ['id' => $this->propertyId, 'value' => $this->propertyValue];
        $this->propertyId = null;
        $this->propertyValue = null;
    }

    public function deleteProperty(int $id): void
    {
        unset($this->properties[$id]);
    }

    public function addCategory(): void
    {
        $this->categories[] = $this->categoryId;
        $this->categoryId = null;
    }

    public function deleteCategory(int $id): void
    {
        unset($this->categories[$id]);
    }

    public function deleteImage(int $id): void
    {
        unset($this->photos[$id]);
    }

    public function store(): void
    {
        $this->authorize('create', Item::class);
        $validated = $this->validateAll();

        \DB::beginTransaction();

        $item = Item::create(Arr::only($validated, ['name', 'description', 'qty', 'price', 'active']));

        if(!empty($validated['photos'])){
            $photos = $this->uploadPhotos($validated['photos'], $item->id);
            $item->photos()->saveMany($photos);
        }

        if(!empty($validated['categories'])){
            $item->categories()->attach($validated['categories']);
        }

        if(!empty($validated['properties'])){
            $item->properties()->attach($this->prepareProperties($validated['properties']));
        }

        \DB::commit();
        
        $this->emitSuccess();
    }

    public function uploadPhotos(array $validatedPhotos, int $itemId): array
    {
        $photos = [];
        foreach ($validatedPhotos as $key => $photo) {
            $photos[] = new Image(['path' => $photo->storeAs('items/'.$itemId, $photo->getClientOriginalName())]);
        }
        return $photos;
    }

    private function validateAll(): array
    {
        $validated = $this->validate([
            'name' => ['required', 'string'],
            'description' => ['string'],
            'properties.*.id' => ['integer', 'min:1'], 
            'properties.*.value' => ['required', 'string'],
            'categories.*' => ['integer', 'min:1'],
            'photos.*' => ['image'],
            'qty' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'regex:/^\d+([\,\.]\d{1,2})?$/'],
            'active' => ['required', 'boolean'],
        ]);
        return $validated;
    }

    private function prepareProperties(array $validatedProperties): array
    {
        $properties = [];
        foreach ($validatedProperties as $key => $property) {
            $properties[$property['id']] = ['value' => $property['value']];
        }
        return $properties;
    }

    public function render()
    {
        $allCategories = Category::get()->keyBy('id');
        $allProperties = Property::with('unit')->get()->keyBy('id');
        return view('livewire.admin.items.create2', compact('allCategories', 'allProperties'));
    }
}