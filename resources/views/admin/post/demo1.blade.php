@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">BACK</a>
    @if($post->is_approved == false)
        <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
            <i class="material-icons">done</i>
            <span>Approve</span>
        </button>
        <form method="POST" action="{{ route('admin.post.approve', $post->id) }}" id="approval-form" style="display: none;">
            @csrf
            @method('PUT')
        </form>
    @else
        <button type="button" class="btn btn-success pull-right" disabled>
            <i class="material-icons">done</i>
            <span>Approved</span>
        </button>
    @endif
    <br/>
    <br/>
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $post->title }}
                        <small>Posted By <strong><a href="">{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }}</small>
                    </h2>
                    {{-- <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                </div>
                <div class="body">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        <b>CATEGORIES</b>
                    </h2>
                    {{-- <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                </div>
                <div class="body">
                    @foreach($post->categories as $category)
                        <span class="label bg-cyan">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        <b>TAGS</b>
                    </h2>
                    {{-- <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                </div>
                <div class="body">
                    @foreach($post->tags as $tag)
                        <span class="label bg-green">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-yellow">
                    <h2>
                        <b>FEATURED IMAGE</b>
                    </h2>
                    {{-- <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                </div>
                <div class="body">
                    <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            //CKEditor
            // CKEDITOR.replace('ckeditor');
            // CKEDITOR.config.height = 300;

            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
            });


        $(document).ready(function(){
            // console.log('Baaaaaaaaaaaaaaad');
            function approvePost(id) {
                swal([
                    title: 'Are you sure?',
                    text: "You want to approve this post!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButton: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButton: true,
                ]).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('approval-form-').submit();
                    }   else if (
                        result.dismiss === swal.DismissReason.cancel
                    )

                    {
                        swal(
                            'cancelled',
                            'The post remains pending :)',
                            'info'
                        )
                    }
                })
            }
        });

        //$(".approvePost").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS?"); });
    </script>
@endpush



{{-- FOR PENDING FORM --}}

@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    {{-- <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"> --}}
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.post.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Post</span>
            </a>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Posts
                            <span class="badge bg-light-blue">{{ $posts->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Is Approved</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Is Approved</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($posts as $key => $post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title, '10') }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>
                                                @if($post->is_approved == true)
                                                    <span class="badge bg-blue">Approved</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($post->status == true)
                                                    <span class="badge bg-blue">Published</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>{{ $post->updated_at }}</td>
                                            <td class="text-center">
                                                @if($post->is_approved == false)
                                                    <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                                                        <i class="material-icons">done</i>
                                                        <span>Approve</span>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.post.approve', $post->id) }}" id="approval-form" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                                                            <i class="material-icons">done</i>
                                                        </button>
                                                    </form>
                                                {{-- @else
                                                    <button type="button" class="btn btn-success pull-right" disabled>
                                                        <i class="material-icons">done</i>
                                                        <span>Approved</span>
                                                    </button> --}}
                                                @endif
                                                <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-info waves-effect"  style="float: left; height: 40px; width: 67px; border: 3px solid light-red;">
                                                    <i class="material-icons">visibility</i>
                                                    <span>Edit</span>
                                                </a>
                                                <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-info waves-effect"  style="float: left; height: 40px; width: 67px; border: 3px solid light-red;">
                                                    <i class="material-icons">edit</i>
                                                    <span>Edit</span>
                                                </a>

                                                <form class="delete" action="{{ route('admin.post.destroy', $post->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                        <button type="submit" value="Delete" class="btn btn-danger waves-effect" style="float: right; width: 72px; border: 3px solid light-red; padding: 8px; margin-left: 10px;">
                                                            <i class="material-icons">delete</i>
                                                            {{-- <style>
                                                                .right {
                                                                    float: right;
                                                                    width: 300px;
                                                                    border: 3px solid #00ffff;
                                                                    padding: 10px;
                                                                }
                                                                </style> --}}
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script> --}}

    {{-- <script class="pull-left">
        $(".delete").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS?"); });
        $(".approvePost").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS?"); });
    </script> --}}


    <script type="text/javascript">
        $(document).ready(function(){
            // console.log('Baaaaaaaaaaaaaaad');
            function approvePost(id) {
                swal([
                    title: 'Are you sure?',
                    text: "You want to approve this post!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButton: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButton: true,
                ]).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('approval-form-').submit();
                    }   else if (
                        result.dismiss === swal.DismissReason.cancel
                    )

                    {
                        swal(
                            'cancelled',
                            'The post remains pending :)',
                            'info'
                        )
                    }
                })
            }
        });
    </script>


@endpush



