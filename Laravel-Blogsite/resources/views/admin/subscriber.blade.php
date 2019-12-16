@extends('backend.pages.master')

@section('title','Post')

{{--css for only this page--}}
@push('css')
    <link href="{{ asset('user/frontend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
@endpush

@section('content')
    @include('messages.errorMsg')


    <div class="container-fluid">

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="header bg-brown">
                            <h2 >
                               All Subscriber
                                <span class="badge bg-blue">{{ $subscriberList->count() }} </span>
                            </h2>


                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Email</th>
                                            <th>Created_at</th>
                                            <th>Updated_at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

@php $k=1; @endphp
@forelse($subscriberList as $row)

                                        <tr>
                                            <th> {{ $k++ }} </th>
                                            <th> {{ $row->email }} </th>
                                            <th>{{ $row->created_at }}</th>
                                            <th>{{ $row->updated_at }}</th>
                                            <th>

                                                <button type="submit" class="btn btn-danger btn-sm waves-effect"  onclick="deleteinfo('{{ $row->id }}')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form action="{{route('admin.subscriber.delete',$row->id)}}" method="post" id="form-id" style="display: none">
                                                    {{ csrf_field() }}
                                                </form>

                                            </th>
                                        </tr>


@empty

    <tr>
        <td colspan="8" class="text-center"> Subscriber not Found! </td>
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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">
        /* ============SweetAlert===================== */
        function deleteinfo(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You want to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes,Delete',
                cancelButtonText: 'No,Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    event.preventDefault();
                    document.getElementById('form-id').submit();

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        }

    </script>

@endpush