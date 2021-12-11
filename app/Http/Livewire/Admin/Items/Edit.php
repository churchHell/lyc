<?php

namespace App\Http\Livewire\Admin\Items;

use App\Exceptions\ItemDuplicateException;
use App\Models\{Category, Item, Property};
use App\Rules\Price;
use App\Http\Livewire\BaseComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;

class Edit extends BaseComponent
{

    use AuthorizesRequests;

    public ?int $itemId = null;

    public array $categories = [];
    public ?int $defaultCategory = null;
    public array $item = ['active' => true];
    public array $properties = [];
    public string $propertyValue = '';

    protected $listeners = ['categoryAdded', 'imagesUploaded'];

    protected function rules()
    {
        return [
            'item.name' => ['required', 'string'],
            'item.description' => ['string'],
            'item.qty' => ['required', 'integer', 'min:0'],
            'item.price' => ['required', new Price],
            'item.active' => ['required', 'boolean'],
        ];
    }

    public function mount(): void
    {
        if($this->itemId) {
            $this->findItem();
        }
        $this->categories = Category::all()->keyBy('id')->toArray();
        $this->properties = Property::all()->keyBy('id')->toArray();
    }

    public function update()
    {
         $item = Item::findOrFail($this->itemId);
         $this->authorize('update', $item);

         if($this->resultIcon($item->update($this->validate()['item']))){
            $this->findItem();
         }
    }

    public function store(): void
    {
        $this->authorize('create', Item::class);

        \DB::beginTransaction();

        try{
            $item = Item::create($this->validate()['item']);
        } catch(ItemDuplicateException $e){
            $this->addError('item.name', $e->getMessage());
            return;
        }

        if ($this->defaultCategory) {
            $item->categories()->attach($this->defaultCategory);
        }

        \DB::commit();

        if(!empty($item) && $item->exists){
            $this->item = $item->load(['categories', 'images', 'properties'])->toArray();
            $this->itemId = $item->id;
            $this->emitSuccess();
        }
    }

    public function deleteImage(int $id)
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);
        if($item->image($id)->delete()){
            $this->findItem();
        }
    }

    public function imagesUploaded(array $images): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->images()->attach($images);
        $this->findItem();
    }

    public function addCategory(int $id): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->categories()->attach($id);
        $this->findItem();
    }

    public function deleteCategory(int $id): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->categories()->detach($id);
        $this->findItem();
    }

    public function addProperty(int $property): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->properties()->attach([$property => ['value' => $this->propertyValue]]);
        $this->findItem();
    }

    public function deleteProperty(int $property): void
    {
        $item = Item::findOrFail($this->itemId);
        $this->authorize('update', $item);

        $item->properties()->detach($property);
        $this->findItem();
    }

    public function findItem(): void
    {
        $this->item = Item::whereId($this->itemId)
            ->with(['categories', 'images', 'properties'])
            ->first()
            ->toArray();
    }

    public function render()
    {
        $existsCategoriesIds = !empty($this->item['categories'])
            ? Arr::pluck($this->item['categories'], 'id')
            : [];
        $filteredCategories = Arr::except($this->categories, $existsCategoriesIds);
        return view('livewire.admin.items.edit', compact('filteredCategories'));
    }
}
