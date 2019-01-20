window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


$(document).ready(function () {
    $('.offsort').dataTable({
        "ordering": false
    });

    $('.summernote').summernote({
        height: 300,
        prettifyHtml: false,
        codemirror: {
            theme: 'monokai',
            mode: 'text/html',
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
});