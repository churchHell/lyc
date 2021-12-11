<div class="fixed top-0 left-0 right-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-800 opacity-50">
    <div class="bg-white">
        <div wire:click="close" class="flex justify-end p-4">X</div>
        <div class="px-8 py-4">
            {{dd($data)}}
            @include($template)
        </div>
    </div>
</div>
