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
        
        $categories=Category::all()->sortBy('title_'.app()->getLocale());
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

        $categories=Category::all()->sortBy('title_'.app()->getLocale());

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
                'category_title_en' => 'required|nullable|unique:categories,title_en',
                'category_title_lt' => 'required|nullable|unique:categories,title_lt',
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
        
        $category->title_en=$request->category_title_en;
        $category->title_lt=$request->category_title_lt;
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
        $categories=Category::all()->sortBy('title_'.app()->getLocale());
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
                'category_title_en' => 'required|nullable',
                
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
            
        if($request->delete_photo){
            $category->deletePhoto();
            if (app()->getLocale() == "lt") {
                $message1 = "Nuotrauka ištrinta";
                
            }
            else {
                $message1 = "Photo deleted";
    
            }
        return redirect()->back()->with('ok', $message1);
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

        $category->title_en=$request->category_title_en;
        $category->title_lt=$request->category_title_lt;
        $category->save();
        if (app()->getLocale() == "lt") {
            $message1 = "Redagavimas baigtas";
            
        }
        else {
            $message1 = "Edit complete";

        }
        return redirect()->route('category-index', ['#'.$category->id])->with('ok', $message1);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {  
        if (app()->getLocale() == "lt") {
            $message1 = "Trynimas baigtas";
            $message2 = "Negalima ištrinti kategorijos. Pimiausiai ištrinkite kategorijai priklausantį maistą";
            
        }
        else {
            $message1 = "Delete complete";
            $message2 = "Can\'t delete Category, first delete food from Category";

        }
        if(!$category->food_Category()->count()){
            $category->deletePhoto();
            $category->delete();
        return redirect()->route('category-index', ['#'.$category->id])->with('ok', $message1);
        }else{
            return redirect()->route('category-index', ['#'.$category->id])->with('not', $message2);
        }
    }
}