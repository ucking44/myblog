@extends('layouts.backend.app')

@section('title', 'Subscribers')

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
                            ALL SUBSCRIBERS
                            <span class="badge bg-light-blue">{{ $subscribers->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($subscribers as $key => $subscriber)
                                        <tr>
                                            {{-- <td>{{ $key + 1 }}</td> --}}
                                            <td>{{ $subscriber->id }}</td>
                                            <td>{{ $subscriber->email }}</td>
                                            {{-- <td>{{ $subscriber->posts->count() }}</td> --}}
                                            <td>{{ $subscriber->created_at }}</td>
                                            <td>{{ $subscriber->updated_at }}</td>
                                            <td class="text-center">

                                                <form class="subscriber" action="{{ route('admin.subscriber.destroy', $subscriber->id) }}" method="POST">
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
        $(".subscriber").on("submit", function(){ return confirm("DO YOU WANT TO DELETE THIS?"); });
    </script>

@endpush

