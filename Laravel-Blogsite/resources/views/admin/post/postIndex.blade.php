@extends('backend.pages.master')

@section('title','Post')

{{--css for only this page--}}
@push('css')
    <link href="{{ asset('user/frontend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
@endpush

@section('content')

    <div class="container-fluid">
        
            <div class="block-header">
                <a class="btn btn-info waves-effect" href="{{ route('admin.post.create') }}">
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
                                EXPORTABLE TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
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
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>
                                                <i class="material-icons">visibility</i>
                                            </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

@forelse($allData as $row)

                                        <tr>
                                            <th> {{ $row->id }} </th>
                                            <th> {{ $row->title }} </th>
                                            <th> {{ $row->user->id }} </th>
                                            <th>
                                                <i class="material-icons">visibility</i>
                                            </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>{{ $row->updated_at }}</th>
                                            <th>Action</th>
                                        </tr>


@empty

    <tr>
        <td colspan="8" > Data not Found! </td>
    </tr>

@endforelse

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
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/jszip.min.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('user/frontend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>


@endpush