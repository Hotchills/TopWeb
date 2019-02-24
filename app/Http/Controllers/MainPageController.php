<?php

namespace App\Http\Controllers;

use App\MainPage;
use Illuminate\Http\Request;
use Session;
use App\Page;
use Illuminate\Validation\Rule;

class MainPageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  //  public function __construct()
  //   {
   //  $this->middleware('auth',['except'=>'index']); 
  //   $this->middleware('admin', ['except' => ['index']]);
 //  }
    public function mainpage($main) {


        if ($mainpage = MainPage::where('name', $main)->first()) {       
            $pages = $mainpage->pages;
            return view('mainpage', compact('mainpage', 'pages'));
        }
        abort(404);
    }

    public function index1() {
        //
        return view('CreateMainPage');
    }
    public function index() {
        //Voyager mainpage 
         // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);
        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        $this->authorize('browse', app($dataType->model_name));
        $getter = $dataType->server_side ? 'paginate' : 'get';
        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $orderBy = $request->get('order_by');
        $sortOrder = $request->get('sort_order', null);
        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model::select('*');
            $relationships = $this->getRelationships($dataType);
            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');
            if ($search->value && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }
            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'DESC';
                $dataTypeContent = call_user_func([
                    $query->with($relationships)->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->with($relationships)->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }
            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }
        // Check if BREAD is Translatable
        if (($isModelTranslatable = is_bread_translatable($model))) {
            $dataTypeContent->load('translations');
        }
        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;
        $view = 'voyager::bread.browse';
        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }
        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'sortOrder',
            'searchable',
            'isServerSide'
        ));
     //   return view('/vendor/voyager/mainpage/mainpage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
       $validatedData = $request->validate([
        'title' => 'required|unique:mainpage|max:100|min:3',
        'name'=> 'required|unique:mainpage|max:40|min:3',
        'body' => 'max:500',
        ]);
         
        $mainpage = new MainPage();
        $mainpage->name = $request->name;
        $mainpage->title = $request->title;
        $mainpage->body = $request->body;
        $mainpage->save();
      
        
        return redirect()->action('MainPageController@index',['main'=>$mainpage->name])->with('message', 'Success');

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function show(MainPage $mainPage) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function edit(MainPage $mainPage) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainPage $mainPage) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainPage $mainPage) {
        //
    }

}
