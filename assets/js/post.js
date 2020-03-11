$(document).ready(function () {
    $('#summernote').summernote({
        height: 400,
        minHeight: null,
        maxHeight: null,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link'/* , 'picture', 'video' */]],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        fontSizes: ['10', '11', '12', '14', '16', '18', '24', '36']
    });
});