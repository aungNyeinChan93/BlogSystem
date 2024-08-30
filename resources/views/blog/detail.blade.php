@extends("layouts.master")

@section("blog")

        <div class="row ">
            <div class="col-6 offset-3 ">
                <div class="card w-100 mx-auto mt-3" style="width: 18rem;">
                    <img src="{{ asset("/blogImage/$blog->image")}}" class="card-img-top" >
                    <div class="card-body">
                      <h5 class="card-title">{{$blog->title}}</h5>
                      <p class="card-text">{{$blog->description}}</p>
                      <small class=" d-block">{{$blog->created_at}}</small>
                      <a href="/" class="btn btn-primary my-2">back</a>
                    </div>
                  </div>
            </div>
        </div>

@endsection
