@extends('layout.master')

@section('content')
    <div class="col-lg-12 mt-4 mb-4">
        <div class="bg-clr-white2 hover-box">
            <center>
                <div class="col-sm-5 position-relative">
                    <a href="{{ url('posts/'.$post->slug) }}" class="image-mobile">
                        <img style="width: 300px" class="card-img-bottom d-block radius-image-full" src="{{$post->photo()}}"
                             alt="Card image cap">
                    </a>
                </div>
                <div class="row">
                    <div class="card-body blog-details align-self">
                        <b>{{ $post->title }}</b>
                        {!! $post->content !!}
                        <div class="author align-items-center">
                            <ul class="blog-meta">
                                <li class="meta-item blog-lesson">
                                    <span class="meta-value"> {{ $post->updated_at }} </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </center>

        </div>
    </div>
@endsection
