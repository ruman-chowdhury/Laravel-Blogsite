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

        <a href="{{ route('author.post') }}" class="btn btn-danger waves-effect">Back</a>

        @if($rows->is_approved == false)
            <button type="button" class="btn bg-pink pull-right">
                <i class="material-icons">cancel</i>
                <span>Pending</span>
            </button>
         @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
         @endif


        <br> <br>
        <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                                {{ $rows->title }}
                                <small>
                                    Posted By <strong> <a> {{ $rows->user->name }} </a></strong>
                                    on {{ $rows->created_at->diffForHumans() }}
                                </small>
                            </h2>
                        </div>

                        <div class="body">

                            {!! $rows->details !!}

                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Category</h2>
                        </div>

                        <div class="body">

                            {{ $rows->category }}

                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-brown">
                            <h2>Featured Image</h2>
                        </div>

                        <div class="body">

                            @if($rows->image != null)

                                <img class="img-thumbnail" src="{{ asset('user/backend/photos/'.$rows->image) }}"  width="304" height="236" >

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
    </script>

@endpush