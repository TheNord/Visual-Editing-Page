@section('scripts')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script>
        $('.summernote').summernote({
            height: 300,
            prettifyHtml: false,
            codemirror: {
                theme: 'monokai',
                mode: 'text/html',
                styleActiveLine: true,
                lineNumbers: true,
                line: true,
                htmlMode: true,
                lineWrapping: true,
            },
            callbacks: {
                onImageUpload: function (files) {
                    var editor = $(this);
                    var url = editor.data('image-url');
                    var data = new FormData();
                    data.append('file', files[0]);
                    axios
                        .post(url, data).then(function (response) {
                        editor.summernote('insertImage', response.data);
                    })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            }
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection