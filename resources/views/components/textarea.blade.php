<div 
        wire:ignore 
        class="" 
        x-data="{value:@entangle('description')}"
        x-init="$refs.trix.editor.loadHTML(value)"
>

        <textarea 
                wire:model.lazy="description" 
                x-ref="trix" 
                name="" 
                id="description" 
                data-description="@this" 
                cols="30" 
                rows="10"
        ></textarea>

</div>