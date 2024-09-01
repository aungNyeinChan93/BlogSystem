@extends('layouts.master')

@section('blog')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <form action="{{ route('update',$blog->id) }}" method="POST" class="my-2" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <img src="{{ asset("/blogImage/$blog->image")}}" alt="" class="d-block mx-auto p-2 img-fluid my-1 w-75" id="upload">
                    <input type="file" name="image"
                        class="form-control my-1 @error('image')
                        is-invalid
                    @enderror"
                        onchange="fileupload(event)">
                    @error('image')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <input type="text" name="title" value="{{ old('title')?? $blog->title }}" placeholder="Enter Title ..."
                        class="form-control my-2  @error('title')
                        is-invalid
                    @enderror">
                    @error('title')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <input type="text" name="writer" value="{{ old('writer')?? $blog->writer }}" placeholder="Enter your name ..."
                        class="form-control my-2 @error('writer')
                        is-invalid
                    @enderror">
                    @error('writer')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <textarea name="description" cols="30" rows="10"
                        class="form-control  @error('description')
                        is-invalid
                    @enderror">
                    {{ old('description')?? $blog->description }}
                    </textarea>
                    @error('description')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <input type="submit" value="Update" class="btn btn-warning btn-sm my-2">
                    <a href="{{route("listPage")}}" class="btn btn-success btn-sm my-2" > Back</a>
                </form>
            </div>
        </div>

    </div>
@endsection

