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
            <a class="btn btn-primary waves-effect" href="{{ route('author.post.create') }}">
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
                                        <th>NO</th>
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
                                        <th>NO</th>
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
                                                <a href="{{ route('author.post.show', $post->id) }}" class="btn btn-info waves-effect"  style="float: left; height: 40px; width: 67px; border: 3px solid light-red;">
                                                    <i class="material-icons">visibility</i>
                                                    <span>Edit</span>
                                                </a>
                                                <a href="{{ route('author.post.edit', $post->id) }}" class="btn btn-info waves-effect"  style="float: left; height: 40px; width: 67px; border: 3px solid light-red;">
                                                    <i class="material-icons">edit</i>
                                                    <span>Edit</span>
                                                </a>

                                                <form class="delete" action="{{ route('author.post.destroy', $post->id) }}" method="POST">
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

    <script class="pull-left">
        $(".delete").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS?"); });
    </script>


@endpush

