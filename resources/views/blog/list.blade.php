@extends('layouts.master')

@section('blog')
    <div class="container">
        <div class="row">
            <div class="px-4">
                @if (session('create'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('create') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @session('delete')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('delete') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endsession
                @session('update')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('update') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endsession
            </div>
            <div class="row">
                <div class="col-4">
                    <form action="{{route("listPage")}}" method="GET">
                        @csrf
                        <div class="input-group mb-3">
                            <input value="{{request()->search_key}}" type="text" name="search_key" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-info" type="submit" id="button-addon2">Search</button>
                          </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <form action="{{ route('create') }}" method="POST" class="my-2" enctype="multipart/form-data">
                    @csrf
                    <img src="" alt="" class="d-block mx-auto p-2 img-fluid my-1 w-75" id="upload">
                    <input type="file" name="image"
                        class="form-control my-1 @error('image')
                        is-invalid
                    @enderror"
                        onchange="fileupload(event)">
                    @error('image')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter Title ..."
                        class="form-control my-2  @error('title')
                        is-invalid
                    @enderror">
                    @error('title')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <input type="text" name="writer" value="{{ old('writer') }}" placeholder="Enter your name ..."
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
                    {{ old('description') }}
                    </textarea>
                    @error('description')
                        <small class=" invalid-feedback p-2"> {{ $message }}</small>
                    @enderror
                    <input type="submit" value="Submit" class="btn btn-success btn-sm my-2">
                </form>
            </div>


            <div class="col">
                @foreach ($blogs as $blog)
                    <div class="card card-body my-4 shadow-sm">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="text-danger text-center">{{ $blog->title }}</h4>
                                <p class="text-muted">{{ Str::words ($blog->description, 50, '...') }}
                                </p>
                                <small class=" h3 text-muted text-danger d-block">{{ $blog->writer }}</small>
                                <span class="text-muted">{{ $blog->created_at->format("j-F-Y")}}</span>
                                <div class="mt-2">
                                    <a href="{{ route("detail",$blog->id)}}" class="btn btn-sm btn-info me-2"> Detail</a>
                                    <a href="{{ route("edit",$blog->id)}}" class="btn btn-sm btn-warning me-2"> Edit </a>
                                    <a href="{{ route('delete', $blog->id) }}" class="btn btn-sm btn-danger me-2"> Delete</a>
                                </div>
                            </div>
                            <div class="col-4 my-auto">
                                <img src="{{ asset("/blogImage/$blog->image") }}" alt="test"
                                    class=" img-thumbnail w-100 rounded ">
                            </div>
                        </div>
                    </div>
                @endforeach

                <!--for pegimation bar  -->
                {{-- {{ $blogs->links() }} --}}



            </div>

        </div>

    </div>
@endsection
