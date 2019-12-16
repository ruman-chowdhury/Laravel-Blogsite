@extends('backend.pages.master')

@section('title','Post')

{{--css for only this page--}}
@push('css')
    <link href="{{ asset('user/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{asset('user/backend/plugins/bootstrap-select/css/bootstrap-select.css')}} " rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">

        <a href="{{ route('admin.post') }}" class="btn btn-danger waves-effect">Back</a>

        @if($row->is_approved == false)
            <button type="submit" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $row->id }})">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>

            <form action="{{ route('admin.post.approve',$row->id) }}" method="post" id="approval-form" style="display: none">
                {{ csrf_field() }}
            </form>

        @else
            <button type="button" class="btn bg-grey pull-right" disabled>
                <span>Approved</span>
            </button>
         @endif



        <br> <br>
        <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                {{ $row->title }}
                                <small>
                                    Posted By <strong> <a> {{ $row->user->name }} </a></strong>
                                    on {{ $row->created_at->diffForHumans() }}
                                </small>
                            </h2>
                        </div>

                        <div class="body">

                            {!! $row->details !!}

                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Category</h2>
                        </div>

                        <div class="body">

                            {{ $row->category }}

                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-brown">
                            <h2>Featured Image</h2>
                        </div>

                        <div class="body">

                            @if($row->image != null)

                                <img class="img-thumbnail" src="{{ asset('user/backend/photos/'.$row->image) }}"  width="304" height="236" >

                            @else

                                    <h4 class="text-secondary text-center"> Image Not Found!</h4>

                            @endif

                        </div>
                    </div>


                </div>


            </div>
            <!-- Vertical Layout | With Floating Label -->



    </div>
@endsection

@push('js')

    <!-- Select Plugin Js -->
    <script src="{{ asset('user/backend/plugins/bootstrap-select/js/bootstrap-select.js') }} "></script>

    <!-- TinyMCE -->
    <script src="{{ asset('user/backend/plugins/tinymce/tinymce.js') }} "></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: "#mytextarea",
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });


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