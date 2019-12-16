@extends('backend.pages.master')

@section('title','Post')

{{--css for only this page--}}
@push('css')
    <link href="{{ asset('user/frontend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
@endpush

@section('content')
    @include('messages.errorMsg')


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

                        <div class="header bg-pink">
                            <h2 >
                               Pending Posts
                            </h2>

                            <!-- Search Bar -->
                            <div class="search-bar">
                                <div class="search-icon">
                                    <i class="material-icons">search</i>
                                </div>
                                <input type="text" placeholder="START TYPING...">
                                <div class="close-search">
                                    <i class="material-icons">close</i>
                                </div>
                            </div>
                            <!-- #END# Search Bar -->
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>
                                                <i class="material-icons">visibility</i>
                                            </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

@php $k=1; @endphp
@forelse($pendingData as $row)

                                        <tr>
                                            <th> {{ $k++ }} </th>
                                            <th> {{ ucwords( strtolower(Str::limit($row->title,'10')) ) }} </th>
                                            <th> {{ $row->user->name }} </th>
                                            <th></th>
                                            <th>
                                                @if($row->is_approved == true)

                                                    <span class="badge bg-blue"> Approved </span>

                                                @else

                                                    <span class="badge bg-pink"> Pending </span>

                                                @endif
                                            </th>
                                            <th>
                                                @if($row->status == true)

                                                    <span class="badge bg-blue"> Published </span>

                                                @else

                                                    <span class="badge bg-pink"> Pending </span>

                                                @endif
                                            </th>
                                            <th>{{ $row->created_at }}</th>
                                            <th>

                                                @if($row->is_approved == false)
                                                    <button type="submit" class="btn btn-success waves-effect " onclick="approvePost({{ $row->id }})">
                                                        <i class="material-icons">done</i>
                                                    </button>

                                                    <form action="{{ route('admin.post.approve',$row->id) }}" method="post" id="approval-form" style="display: none">
                                                        {{ csrf_field() }}
                                                    </form>

                                                @endif


                                                <a class="btn btn-dark waves-effect"  href="{{route('admin.post.view',$row->id)}}">
                                                    <i class="material-icons">visibility</i>
                                                </a>

                                                <a class="btn btn-info btn-sm waves-effect" href="{{route('admin.post.edit',$row->id)}}">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <a class="btn btn-danger btn-sm waves-effect" href="{{route('admin.post.delete',$row->id)}}" onclick="return confirm('Are you sure to delete?')">
                                                    <i class="material-icons">delete</i>
                                                </a>

                                            </th>
                                        </tr>


@empty

    <tr>
        <td colspan="8" class="text-center"> Data not Found! </td>
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

    </div> <!--container-->

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



    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">

        /* ============SweetAlert===================== */

        function approvePost(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You want to approve this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    event.preventDefault();
                    document.getElementById('approval-form').submit();

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your post remain pending :)',
                        'info'
                    )
                }
            })
        }

    </script>

@endpush