@extends('layouts.backend.app')

@section('title', 'Comments')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    {{-- <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet"> --}}
@endpush

@section('content')
    <div class="container-fluid">
        {{-- <div class="block-header">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.post.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Post</span>
            </a>
        </div> --}}
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Comments
                            {{-- <span class="badge bg-blue">{{ $posts->comment->count() }}</span> --}}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Comments Info</th>
                                        <th class="text-center">Post Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Comments Info</th>
                                        <th class="text-center">Post Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($posts as $key => $post)
                                    @foreach($post->comments as $comment)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{ $comment->user->name }}
                                                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                        </h4>
                                                        <p>{{ $comment->comment }}</p>
                                                        <a target="_blank" href="{{ route('post.details', $comment->post->slug. '#comments') }}">Reply</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-right">
                                                        <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}">
                                                            <img class="media-object" src="{{ Storage::disk('public')->url('post/'.$comment->post->image) }}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}"><h4 class="media-heading">{{ str_limit($comment->post->title, '40') }}</h4>
                                                        </a>
                                                        <p>by<strong>{{ $comment->post->user->name }}</strong></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form class="comment" action="{{ route('author.comment.destroy', $comment->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button type="submit" value="Delete" class="btn btn-danger waves-effect" style="float: right; width: 75px; border: 3px solid light-red; padding: 8px; margin-left: 10px;">
                                                        <i class="material-icons">delete</i>
                                                        <style>
                                                            .right {
                                                                float: right;
                                                                width: 300px;
                                                                border: 3px solid #00ffff;
                                                                padding: 10px;
                                                            }
                                                        </style>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
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
        $(".comment").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS COMMENT?"); });
        // $(".approvePost").on("submit", function(){ return confirm("DO YOU WANT TO APPROVE THIS POST?"); });
    </script>

@endpush



