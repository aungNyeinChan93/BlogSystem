<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    # list page -> /list
    public function list()
    {
        // dd(request()->search_key);

        if (request()->search_key == "") {
            $blogs = Blog::orderBy("id", "desc")->paginate(10);
        } else {
            $blogs = Blog::orwhere("title", "like", "%" . request("search_key") . "%")
                    ->orWhere("description","like","%".request("search_key")."%")
                    ->orWhere("writer","like","%".request()->search_key."%")
                    ->orderBy("id", "desc")->paginate(10);
        }
        return view("blog.list", compact("blogs"));

        # Can use -> when()
        // $blogs = Blog::when(request("search_key"), function ($query) {
        //     $query->whereAny(["title","description","writer"], "like", "%" . request("search_key") . "%");
        // })->orderBy("id", "desc")->paginate(10);
        // return view("blog.list", compact("blogs"));
    }

    # create data & validation
    public function create(BlogRequest $blogRequest, Blog $blog)
    {
        if ($blogRequest->hasFile("image")) {
            $file = $blogRequest->file("image");  //$_FILES["image];
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move(public_path() . "/blogImage/", $fileName);
        }
        $blog->create([
            "title" => $blogRequest->title,
            "description" => $blogRequest->description,
            "writer" => $blogRequest->writer,
            "image" => $fileName,  //$blogRequest->file("image)->getClientOriginalName();
        ]);
        Alert::success('Blog created', 'create Success!');
        return back();
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

    public function update(Request $request, Blog $blog)
    {
        // $validateRequest = $request->validated();
        $this->updateValidation($request);
        $oldImage = $blog->image;
        if ($request->hasFile("image")) {
            if (file_exists(public_path("/blogImage/$oldImage"))) {
                unlink(public_path("/blogImage/$oldImage"));
            }
            $newFileName = uniqid() . $request->file("image")->getClientOriginalName();
            $request->file("image")->move(public_path() . "/blogImage/", $newFileName);
            $blog->update([
                "title" => $request->title,
                "description" => $request->description,
                "writer" => $request->writer,
                "image" => $newFileName,
            ]);
        } else {
            $blog->update([
                "title" => $request->title,
                "description" => $request->description,
                "writer" => $request->writer,
            ]);
        }
        return to_route("listPage")->with("update", "Update success!");
    }

    protected function updateValidation($request)
    {
        $validateData = [
            "title" => "required ",
            "description" => "required",
            "writer" => "required",
            "image" => "mimes:jpj,png,svg"
        ];
        $request->validate($validateData);
    }
}
