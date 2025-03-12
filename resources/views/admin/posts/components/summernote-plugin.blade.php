<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<link rel="stylesheet" href="{{ asset('resources/css/summernote-image-list.min.css') }}">
<script src="{{ asset('resources/js/summernote-image-list.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .note-editor .note-editable {
        background-color: white;
        color: black;
    }
</style>
@if (isset($id))
    <textarea id="{{ $id }}" name="{{ $name }}" class="summernote">
        {{ $value }}
    </textarea>

    <script>
        $(document).ready(function() {
            $('#{{ $id }}').summernote({
                placeholder: 'content...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ["style", ["bold", "italic", "underline", "clear"]],
                    ["fontname", ["fontname"]],
                    ["fontsize", ["fontsize"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["height", ["height"]],
                    ["insert", ["link", "picture", "imageList", "video", "hr"]],
                    ["help", ["help"]]
                ],
                dialogsInBody: true,
                imageList: {
                    endpoint: "/images/list",
                    fullUrlPrefix: "{{ asset('images/uploads') }}/",
                    thumbUrlPrefix: "{{ asset('images/uploads') }}/"
                }
            })
        });
    </script>
@endif
