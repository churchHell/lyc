<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
<script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .then( editor => {
            document.querySelector('#submit').addEventListener('click', () => {
                let description = $('#description').data('description');
                eval(description).set('description', editor.getData());
        })
    } )
        .catch( error => {
             console.error( error );
     } );
</script>