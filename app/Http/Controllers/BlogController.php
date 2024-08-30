<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    # list page -> /list
    public function list()
    {
        $blogs = Blog::orderBy("id", "desc")->paginate(10);
        return view("blog.list", compact("blogs"));
    }

    # create data & validation
    public function create(BlogRequest $blogRequest, Blog $blog)
    {
        if ($blogRequest->hasFile("image")) {
            $file = $blogRequest->file("image");
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move(public_path() . "/blogImage/", $fileName);
        }
        $blog->create([
            "title" => $blogRequest->title,
            "description" => $blogRequest->description,
            "writer" => $blogRequest->writer,
            "image" => $fileName,  //$blogRequest->file("image)->getClientOriginalName();
        ]);
        return back()->with(["create" => "Blog create Success!"]);
    }

    public function delete(Blog $blog)
    {
        $oldImage = $blog->image;
        if (file_exists(public_path("/blogImage/$oldImage"))) {
            unlink(public_path("/blogImage/$oldImage"));
        }
        $blog->delete();
        return back()->with("delete", "Delete success!");
    }

    public function detail(Blog $blog)
    {
        return view("blog.detail", compact("blog"));
    }

    public function edit(Blog $blog)
    {
        return view("blog.edit", compact("blog"));
    }

    public function update(BlogRequest $blogRequest, Blog $blog)
    {
        $oldImage = $blog->image;
        if (file_exists(public_path("/blogImage/$oldImage"))) {
            unlink(public_path("/blogImage/$oldImage"));
        }
        $fileName = uniqid() . $blogRequest->file("image")->getClientOriginalName();
        $blogRequest->file("image")->move(public_path() . "/blogImage/", $fileName);
        $blog->update([
            "title" => $blogRequest->title,
            "description" => $blogRequest->title,
            "writer" => $blogRequest->title,
            "image" => $fileName,
        ]);

        return to_route("listPage")->with("update","Update success!");
    }
}
