@extends('layout.master')

@section('content')
    @foreach($categories as $category)
        <div class="w3l-homeblock2 w3l-homeblock5 py-5">
            <div class="container py-lg-5 py-md-4">
                <!-- block -->
                <div class="left-right">
                    <h3 class="section-title-left mb-sm-4 mb-2"> {{ $category->name }}</h3>
                    <a href="{{ url('categories/'. $category->slug) }}" class="more btn btn-small mb-sm-0 mb-4">View more</a>
                </div>
                <div class="row">
                    @foreach($category->posts as $post)
                        <div class="col-lg-6 mt-4">
                            <div class="bg-clr-white hover-box">
                                <div class="row">
                                    <div class="col-sm-5 position-relative">
                                        <a href="{{ url('posts/'.$post->slug) }}" class="image-mobile">
                                            <img class="card-img-bottom d-block radius-image-full" style="width: 250px" src="{{$post->photo()}}"
                                                 alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="col-sm-7 card-body blog-details align-self">
                                        <a href="{{ url('posts/'.$post->slug) }}" class="blog-desc">{{ $post->title }}
                                        </a>
                                        <div class="author align-items-center">
                                            <ul class="blog-meta">
                                                <li class="meta-item blog-lesson">
                                                    <span class="meta-value"> {{ $post->updated_at }} </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endforeach
@endsection
