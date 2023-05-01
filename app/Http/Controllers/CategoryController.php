<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Request;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories=Category::all()->sortBy('title');
        $foods = Food::orderBy('created_at', 'desc')->get();

        return view('back.category.index',[
            'categories'=> $categories,
            'foods'=> $foods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Category::all()->sortBy('title');

        return view('back.category.create',[
            'categories'=> $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(),
            [
                'category_title' => 'required|nullable|unique:categories,title',
                'photo' => 'required|nullable',
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
            
        $category = new Category;
            
        if($request->file('photo')){
        $photo = $request->file('photo');
        $ext = $photo->getClientOriginalExtension();
        $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
        $file = $name.'-'.time().'.'.$ext;
        $photo->move(public_path().'/images',$file);
        $category->photo='/'.'images/'.$file;
        }else{
        $category->photo='/images/temp/noimage.jpg';
        }
        
        $category->title=$request->category_title;
        $category->save();
        return redirect()->route('category-index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories=Category::all()->sortBy('title');
        return view('back.category.edit',[
            'category'=> $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
         $validator = Validator::make(
            $request->all(),
            [
                'category_title' => 'required|nullable',
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
            
        if($request->delete_photo){
            $category->deletePhoto();
        return redirect()->back()->with('ok', 'Photo deleted');
        }
        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);            
            $file = $name.'-'.time().'.'.$ext;
 
        if($category->photo){
            $category->deletePhoto();
            }
            $photo->move(public_path().'/images',$file);
            $category->photo='/'.'images/'.$file;
        }

        $category->title=$request->category_title;
        $category->save();
        return redirect()->route('category-index', ['#'.$category->id])->with('ok', 'Edit complete');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    { 
        if(!$category->food_Category()->count()){
            $category->deletePhoto();
            $category->delete();
        return redirect()->route('category-index', ['#'.$category->id])->with('ok', 'Delete complete');
        }else{
            return redirect()->route('category-index', ['#'.$category->id])->with('not', ' Can\'t Delete Category, firs delete food from category');
        }
    }
}