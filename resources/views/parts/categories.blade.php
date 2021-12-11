<div class="flex flex-col text-center md:text-left">
    
    @forelse($categories as $category)

        <a href="{{ route('category.index', $category->slug) }}" class="my-1">{{ $category->name }}</a>

    @empty
    @endforelse

</div>