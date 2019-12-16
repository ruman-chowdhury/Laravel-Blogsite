@extends('frontend.pages.master')

@section('title','Index')

{{--css for only this page--}}
@push('css')
    <link href="{{ asset('user/frontend/css/home/styles.css') }} " rel="stylesheet">
    <link href="{{ asset('user/frontend/css/home/responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('user/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{asset('user/backend/plugins/bootstrap-select/css/bootstrap-select.css')}} " rel="stylesheet" />
@endpush

@section('content')

    <div class="main-slider container-fluid">
        <div class="swiper-container-fade position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <a class="slider-category" href="#">
                        <div class="blog-image"><img src=" {{ asset('user/backend/images/animation-bg.jpg') }} " alt="Blog Image"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>HR Blog</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container-fluid">

            <div class="row clearfix">

                <div class="col-lg-10 ">
                    <div class="row clearfix">

                @foreach($posts as $post)

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">

                            <div class="card h-100">
                                <div class="single-post post-style-1">

                                    <div class="blog-image">
                                        <img src="{{ asset('user/backend/photos/'.$post->image) }}" alt="{{ $post->title }}">
                                    </div>

                                    <a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a>

                                    <div class="blog-info">
                                        <h4 class="title"><a href="#"><b>{{ $post->title }}</b></a>
                                        </h4>

                                        <ul class="post-footer">
                                            <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                            <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                            <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                        </ul>
                                    </div><!-- blog-info -->

                                </div><!-- single-post -->
                            </div><!-- card -->

                        </div>

                 @endforeach

                    </div>
                </div><!-- col-lg-10 col-md-6 -->



                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="card">

                                <div class="body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>
                                                <h3 class="text-center">CATEGORY</h3>
                                            </th>

                                        </tr>
                                        </thead>
                                    @foreach( $posts as $post)
                                        <tr>
                                            <td>
                                                <a href="">{{ $post->category }} </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div><!-- row -->

            <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->


@endsection


