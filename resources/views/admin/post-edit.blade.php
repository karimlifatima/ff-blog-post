@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <h1>Edit blog post</h1>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form role="form" method="post" action="{{ route('admin.post.update', $post->slug) }}" enctype="multipart/form-data" id="quickForm">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title" value="{{ old("title") ?? $post->title ?? "" }}" class="form-control title" id="exampleInputEmail1" placeholder="Enter title">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slug</label>
                                    <input type="text" name="slug" value="{{ old("slug") ?? $post->slug ?? "" }}" class="form-control" id="exampleInputPassword1" placeholder="Slug">
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if($post->hasPhoto())
                                    <div class="mb-4">
                                        <img src="{{ $post->photo() }}" style="width: 400px" alt="">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="customFile">Blog Photo</label>

                                    <div class="custom-file">
                                        <input type="file" name="photo" value="{{ old("photo") }}" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose photo</label>
                                    </div>
                                    @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select2" multiple="multiple" name="categories[]" data-placeholder="Select a Category" style="width: 100%;">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (collect(old('categories') ?? $post->categories->pluck('id') ?? null)->contains($category->id)) ? 'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <textarea class="textarea" placeholder="Place some text here" name="content"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old("content") ?? $post->content ?? ""  }}</textarea>
                                    @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" @if($post->editors_choice) checked @endif name="editors_choice" class="custom-control-input" value="1" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">Editor's choice</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
    </section>
@stop

@section('js')
    <script>
        $('.select2').select2()

        tinymce.init({
            selector: '.textarea'
        });

        bsCustomFileInput.init();
    </script>
@endsection


@section('plugins.Select2', true)
@section('plugins.Tinymce', true)
@section('plugins.BsCustomFileInput', true)
