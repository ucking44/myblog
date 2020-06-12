@extends('layouts.backend.app')

@section('title', 'Authors')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    {{-- <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"> --}}
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Authors
                            <span class="badge bg-light-blue">{{ $authors->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Posts</th>
                                        <th>Comments</th>
                                        <th>Favorite Posts</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Posts</th>
                                        <th>Comments</th>
                                        <th>Favorite Posts</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($authors as $key => $author)
                                        <tr>
                                            {{-- <td>{{ $key + 1 }}</td> --}}
                                            <td>{{ $author->id }}</td>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->posts_count }}</td>
                                            <td>{{ $author->comments_count }}</td>
                                            <td>{{ $author->favorite_posts_count }}</td>
                                            <td>{{ $author->created_at->toDateString() }}</td>
                                            <td class="text-center">
                                                <form class="deleteAuthor" action="{{ route('admin.author.destroy', $author->id) }}" method="POST">
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

                                                {{-- <button class="btn btn-danger waves-effect" type="button" onclick="deleteCategory({{ $category->id }})">
                                                        <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form> --}}
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
        $(".deleteAuthor").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS?"); });
    </script>

@endpush

