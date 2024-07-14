@extends('dashboard.template.content')
@section('active-blog', 'active')
@section('expanded-blog', 'true')
@section('show-blog', 'show')
@section('show-blog-post', 'show')
@section('title', 'Data Post')
@section('subtitle', 'Post')

@section('css')
    <link rel="stylesheet" type="text/css" href='{{ asset('filepond/css/filepond.css') }}' />
    <link rel="stylesheet" type="text/css" href='{{ asset('filepond/css/filepond.min.css') }}' />
    <link rel="stylesheet" type="text/css"
        href='{{ asset('filepond/plugin/image-preview/filepond-plugin-image-preview.min.css') }}' />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/select2/dist/css/select2.min.css') }}">

    <link href="{{ asset('sun-editor/css/suneditor.min.css') }}" rel="stylesheet" type="text/css">
    <!-- codeMirror -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.css">
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css">
@endsection

@section('card-content')
    <!-- Light table -->
    <div class="card-body">
        @isset($dataEdit)
            {{ Form::model($dataEdit, ['route' => ['update-blog-post', $dataEdit->id], 'method' => 'POST']) }}
        @else
            {{ Form::open(['route' => 'store-blog-post']) }}
        @endisset
        {{ csrf_field() }}
        <div class="pl-lg-4">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-air-baloon"></i></span>
                    <span class="alert-text"><strong>Gagal!</strong> Data gagal diinputkan, silahkan cek form
                        kembali!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="form-group">
                <label class="form-control-label">Title</label>
                {{ Form::text('title', old('title'), [
                    'class' => 'form-control',
                    'id' => 'title',
                    'maxlength' => '250',
                    'required' => 'required',
                ]) }}
                @error('title')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                {!! htmlspecialchars_decode(Form::label('category_id', 'Category', ['class' => ' form-control-label'])) !!}
                {!! Form::select(
                    'category_id',
                    [] +
                        App\Models\Blog\Category::where('status', 'Active')->pluck('name', 'id')->all(),
                    null,
                    ['class' => 'form-control', 'id' => 'category'],
                ) !!}
                {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                {!! htmlspecialchars_decode(Form::label('tags', 'Tag', ['class' => ' form-control-label'])) !!}
                {!! Form::select(
                    'tags[]',
                    [] +
                        App\Models\Blog\Tag::where('status', 'Active')->pluck('name', 'id')->all(),
                    null,
                    ['class' => 'form-control multi-select', 'multiple' => 'multiple', 'id' => 'tag'],
                ) !!}
                {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group">
                <label class="form-control-label">Image</label>
                {{ Form::file('thumbnail', ['class' => 'my-pond']) }}
            </div>

            <div class="form-group">
                <label class="form-control-label">Status</label>
                {{ Form::select('status', ['Active' => 'Yes', 'Inactive' => 'No'], old('status'), ['class' => 'form-control']) }}
                @error('status')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label">Content <br>
                    <a href="{{ route('elfinder') }}" target="_blank">Image
                        Link</a> {{ asset('images/portfolio/') }}</label>
                {{ Form::textarea('content', old('content'), [
                    'class' => 'form-control',
                    'id' => 'editor',
                    'rows' => 3,
                    'maxlength' => '300',
                    'required' => 'required',
                ]) }}
                @error('content')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">

                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button mt-2" class="btn btn-outline-default" onclick="history.go(-1);">Cancel</button>
                </div>
            </div>
        </div>

        {{ Form::close() }}

    </div>
    <div class="card-footer py-4">
        <nav aria-label="...">


        </nav>
    </div>

@endsection

@section('js')

    <script type="text/javascript" src='{{ asset('jquery-maxlength/bootstrap-maxlength.js') }}'></script>
    <script type="text/javascript" src='{{ asset('dashboard/assets/js/jquery.maskMoney.js') }}'></script>
    <script type="text/javascript" src='{{ asset('dashboard/assets/js/rupiah.js') }}'></script>

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

    <script src="{{ asset('dashboard/assets/vendor/select2/dist/js/select2.min.js') }}"></script>

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
            height: '500px',
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
                        'lineHeight'
                    ],
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

    <script>
        $('.select2').select2();
        $('#tag').select2({
            multiple: true,
            width: '100%',
            height: '30px',
            placeholder: {
                id: '', // the value of the option
                text: 'Select an option'
            },
            allowClear: true
        });

        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginImageResize,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );

        $(function() {
            const _inputElement = document.querySelector('input[name="thumbnail"]');
            const _pond = FilePond.create(_inputElement, {
                allowMultiple: false,
                allowFileEncode: true,
                allowFileSizeValidation: true,
                allowFileTypeValidation: true,
                maxFileSize: '3MB',
                labelMaxFileSize: 'Maksimum File Sebesar 3MB',
                fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',
                maxFiles: 1,
                required: false,
                maxParallelUploads: 1,
                instantUpload: false,
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg'],
                imagePreviewMaxFileSize: '3MB',
                imagePreviewHeight: 150,
            });

            @if (isset($dataEdit))
                @if ($thumbnail != null)
                    _pond.addFile('{{ $thumbnail }}');
                @else
                @endif
            @else
            @endif

        });
    </script>
@endsection
