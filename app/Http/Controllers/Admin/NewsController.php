<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(10);
        return view("admin.news.index", compact('news'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.news.form", compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
           "title" => "required",
           "content" => "required|min:10",
           "category_id" => "required",
           "image" => "required"
        ]);
        $message = "News created successfully";

        try {
            DB::beginTransaction();

            $news = new News();
            $news->title = $request->input('title');
            $news->content = $request->input('content');
            $news->category_id = $request->input('category_id');
            $image = $request->file("image");
            $filename = md5(uniqid()) . "." . $image->getClientOriginalExtension();
            $image->move(public_path("uploads"), $filename);
            $news->image = $filename;
            $news->save();

            $this->LogAct($request->title.' '.$message);

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect(route('news.index'))->with("message", $message);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('admin.news.detail', compact('news'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $news = News::find($id);
        return view("admin.news.form", compact('categories', 'news'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required",
            "content" => "required|min:10",
            "category_id" => "required",
            "image" => "mimes:jpeg,jpg,png,gif"
        ]);
        $news = News::find($id);
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->input('category_id');
        if($request->hasFile("image")) {
            $image = $request->file("image");
            $filename = md5(uniqid()) . "." . $image->getClientOriginalExtension();
            $image->move(public_path("uploads"), $filename);
            $news->image = $filename;
        }
        $news->save();
        return redirect(route('news.index'))->with("message", "News updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::find($id)->delete();
        return redirect(route('news.index'))->with("message", "News deleted successfully");
    }
}
