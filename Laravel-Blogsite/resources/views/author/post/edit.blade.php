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

        <div class="block-header">
            <h2>POST BODY</h2>
        </div>
        <!-- Vertical Layout | With Floating Label -->

        <form action="{{ route('author.post.update',$singleData->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Post</h2>
                        </div>

                        <div class="body">

                            <div class="form-group ">
                                <div class="form-line">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" id="email_address" class="form-control" value="{{ $singleData->title }}">
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="cat">Select category</label>
                                <select id="cat" name="category" class="show-tick" data-live-search="true">

                                    <option value="Education"> Education </option>
                                    <option value="Health"> Health </option>
                                    <option value="Motivation"> Motivation </option>
                                    <option value="Religion"> Religion </option>
                                    <option value="Technology"> Technology </option>
                                    <option value="Others"> Others </option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label class="form-label">Featured Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="header">
                            <h2>Description</h2>
                        </div>


                        <div class="body">
                            <textarea name="details" id="mytextarea"> {{ $singleData->details }} </textarea>
                        </div>


                    </div>
                </div>
            </div>

            <br>
            <div class="form-group">
                <a type="button" href="{{ route('author.post') }}" class="btn btn-danger waves-effect">Cancel</a>
                <button type="submit" class="btn btn-primary waves-effect">Update</button>
            </div>

        </form>
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