@extends('dashboard.template.content')
@section('title', 'Setting')
@section('active-profile', 'Account Setting')

@section('css')
    <link rel="stylesheet" type="text/css" href='{{ asset('filepond/css/filepond.css') }}' />
    <link rel="stylesheet" type="text/css" href='{{ asset('filepond/css/filepond.min.css') }}' />
    <link rel="stylesheet" type="text/css"
        href='{{ asset('filepond/plugin/image-preview/filepond-plugin-image-preview.min.css') }}' />
    <link href="{{ asset('sun-editor/css/suneditor.min.css') }}" rel="stylesheet" type="text/css">
    <!-- codeMirror -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.css">
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css">
@endsection

@section('card-content')
    <!-- Light table -->
    <div class="card-body">
        <form action="{{ route('update-ums-users', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="pl-lg-4">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>Failed!</strong> {{ session('failed') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-control-label">Name</label>
                    <input type="text" name="username" value="{{ auth()->user()->name }}" class="form-control" id="name" maxlength="50">
                    <!-- @error('name')
                    <p class="text-warning small">{{ $message }}</p>
            @enderror -->
                </div>

                <div class="form-group">
                    <label class="form-control-label">E-mail</label>
                    <input type="text" name="email" value="{{ auth()->user()->email }}" class="form-control" id="email" maxlength="75">
                    <!-- @error('email')
                    <p class="text-warning small">{{ $message }}</p>
            @enderror -->
                </div>

                <div class="form-group">
                    <label class="form-control-label">Phone Number</label>
                    <input type="number" name="phone_number" value="{{ auth()->user()->phone_number }}" class="form-control" id="phone_number" maxlength="20">
                    <!-- @error('phone_number')
                    <p class="text-warning small">{{ $message }}</p>
            @enderror -->
                </div>

                <div class="form-group">
                    <label class="form-control-label">Avatar</label>
                    <input type="file" name="avatar" class="my-pond">
                    <!-- @error('avatar')
                    <p class="text-warning small">{{ $message }}</p>
            @enderror -->
                </div>

                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">

                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <button type="submit" class="btn btn-dark">Submit</button>
                        <button type="button" class="btn btn-outline-default" onclick="history.go(-1);">Cancel</button>
                    </div>
                </div>

            </div>
        </form>

    </div>
    <div class="card-footer py-4">
        <nav aria-label="...">


        </nav>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src='{{ asset('sun-editor/js/common.js') }}'></script>
    <script type="text/javascript" src='{{ asset('sun-editor/js/suneditor.min.js') }}'></script>
    <!-- codeMirror -->
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/xml/xml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/css/css.js"></script>
    <!-- KaTeX -->
    <script src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js"></script>
    <script>
        var editor = SUNEDITOR.create('editor', {
            display: 'block',
            name: 'users',
            width: '100%',
            height: 'auto',
            popupDisplay: 'full',
            charCounter: true,
            charCounterLabel: 'Characters :',
            imageGalleryUrl: 'https://etyswjpn79.execute-api.ap-northeast-1.amazonaws.com/suneditor-demo',
            buttonList: [
                // default
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['paragraphStyle', 'blockquote'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table', 'link', 'image', 'video', 'audio', 'math'],
                ['imageGallery'],
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print'],
                ['save', 'template'],
                // (min-width: 1565)
                ['%1565', [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['table', 'link', 'image', 'video', 'audio', 'math'],
                    ['imageGallery'],
                    ['fullScreen', 'showBlocks', 'codeView'],
                    ['-right', ':i-More Misc-default.more_vertical', 'preview', 'print', 'save', 'template']
                ]],
                // (min-width: 1455)
                ['%1455', [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['table', 'link', 'image', 'video', 'audio', 'math'],
                    ['imageGallery'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ]
                ]],
                // (min-width: 1326)
                ['%1326', [
                    ['undo', 'redo'],
                    ['font', 'fontSize', 'formatBlock'],
                    ['paragraphStyle', 'blockquote'],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ],
                    ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio',
                        'math', 'imageGallery'
                    ]
                ]],
                // (min-width: 1123)
                ['%1123', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock',
                        'paragraphStyle', 'blockquote'
                    ],
                    ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                    ['fontColor', 'hiliteColor', 'textStyle'],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ],
                    ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio',
                        'math', 'imageGallery'
                    ]
                ]],
                // (min-width: 817)
                ['%817', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock',
                        'paragraphStyle', 'blockquote'
                    ],
                    ['bold', 'underline', 'italic', 'strike'],
                    [':t-More Text-default.more_text', 'subscript', 'superscript', 'fontColor',
                        'hiliteColor', 'textStyle'
                    ],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ],
                    ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio',
                        'math', 'imageGallery'
                    ]
                ]],
                // (min-width: 673)
                ['%673', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock',
                        'paragraphStyle', 'blockquote'
                    ],
                    [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript',
                        'superscript', 'fontColor', 'hiliteColor', 'textStyle'
                    ],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    ['align', 'horizontalRule', 'list', 'lineHeight'],
                    [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math',
                        'imageGallery'
                    ],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ]
                ]],
                // (min-width: 525)
                ['%525', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock',
                        'paragraphStyle', 'blockquote'
                    ],
                    [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript',
                        'superscript', 'fontColor', 'hiliteColor', 'textStyle'
                    ],
                    ['removeFormat'],
                    ['outdent', 'indent'],
                    [':e-More Line-default.more_horizontal', 'align', 'horizontalRule', 'list',
                        'lineHeight'],
                    [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math',
                        'imageGallery'
                    ],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ]
                ]],
                // (min-width: 420)
                ['%420', [
                    ['undo', 'redo'],
                    [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock',
                        'paragraphStyle', 'blockquote'
                    ],
                    [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript',
                        'superscript', 'fontColor', 'hiliteColor', 'textStyle', 'removeFormat'
                    ],
                    [':e-More Line-default.more_horizontal', 'outdent', 'indent', 'align', 'horizontalRule',
                        'list', 'lineHeight'
                    ],
                    [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math',
                        'imageGallery'
                    ],
                    ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView',
                        'preview', 'print', 'save', 'template'
                    ]
                ]]
            ],
            placeholder: 'Start typing something...',
            templates: [{
                name: 'Template-1',
                html: '<p>HTML source1</p>'
            }],
            codeMirror: CodeMirror,
            katex: katex
        });

        editor.onChange = function(contents, core) {
            $('#editor').val(contents)
        }
    </script>
    <script type="text/javascript" src='{{ asset('jquery-maxlength/bootstrap-maxlength.js') }}'></script>
    <script>
        $(document).ready(function() {
            $('#name').maxlength()
            $('#username').maxlength()
            $('#password').maxlength()
            $('#confirm_password').maxlength()
            $('#phone_number').maxlength()
            $('#email').maxlength()
        });
    </script>

    <script type="text/javascript" src='{{ asset('filepond/plugin/file-encode/filepond-plugin-file-encode.min.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('filepond/plugin/image-resize/filepond-plugin-image-resize.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('filepond/plugin/image-preview/filepond-plugin-image-preview.min.js') }}'>
    </script>
    <script type="text/javascript"
        src='{{ asset('filepond/plugin/file-validate-size/filepond-plugin-file-validate-size.js') }}'></script>
    <script type="text/javascript"
        src='{{ asset('filepond/plugin/file-validate-type/filepond-plugin-file-validate-type.js') }}'></script>
    <script type="text/javascript" src='{{ asset('filepond/js/filepond.min.js') }}'></script>

{{--    <script>--}}
{{--        FilePond.registerPlugin(--}}
{{--            FilePondPluginFileEncode,--}}
{{--            FilePondPluginImageResize,--}}
{{--            FilePondPluginFileValidateSize,--}}
{{--            FilePondPluginFileValidateType,--}}
{{--            FilePondPluginImagePreview--}}
{{--        );--}}

{{--        $(function() {--}}
{{--            const _inputElement = document.querySelector('input[name="avatar"]');--}}
{{--            const _pond = FilePond.create(_inputElement, {--}}
{{--                allowMultiple: false,--}}
{{--                allowFileEncode: true,--}}
{{--                allowFileSizeValidation: true,--}}
{{--                allowFileTypeValidation: true,--}}
{{--                maxFileSize: '3MB',--}}
{{--                labelMaxFileSize: 'Maksimum File Sebesar 3MB',--}}
{{--                fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',--}}
{{--                maxFiles: 1,--}}
{{--                required: false,--}}
{{--                maxParallelUploads: 1,--}}
{{--                instantUpload: false,--}}
{{--                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg'],--}}
{{--                imagePreviewMaxFileSize: '3MB',--}}
{{--                imagePreviewHeight: 150,--}}
{{--            });--}}

{{--            @if (auth()->user() != null)--}}
{{--                @if ($img != null)--}}
{{--                    _pond.addFile('{{ $img }}');--}}
{{--                @else--}}
{{--                @endif--}}
{{--            @else--}}
{{--            @endif--}}

{{--        });--}}
{{--    </script>--}}
@endsection
