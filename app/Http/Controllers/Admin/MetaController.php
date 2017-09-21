<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Meta;
use DB;
use Config;
use App\Http\Controllers\Admin\AdminController;

class MetaController extends AdminController {

    public function __construct(Request $request) {
        
        $this->setSearchArray(array(0 => 'url', 1 => 'website_title', 2 => 'meta_keyword'));
        $this->setFormValidator($request, [
            'website_title' => 'required',
            'page_url' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $metaList = Meta::whereNull('deleted_at')->paginate(5);
        // $cmsList = Cms::orderBy('id','DESC')->paginate(2);
        //dd($metaList);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.meta.index', compact('metaList', 'placeholder_string'));
        // ->with('i', ($request->input('page', 1) - 1) * 2);
    }

    public function metaSearch(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('meta.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $metaList = DB::table('metas')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $metaList->appends(array('q' => $q));

        return view('admin.meta.index', compact('metaList', 'q', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.meta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!is_null($return = $this->checkValidation()))
            return $return;
        $meta = new Meta;

        $meta->url = $request->page_url;
        $meta->website_title = $request->website_title;
        $meta->meta_title = $request->meta_title;
        $meta->meta_keyword = $request->meta_keyword;
        $meta->meta_description = $request->meta_description;

        if ($meta->save())
            return redirect()->route('meta.index')->with('success', 'Meta '.Config::get('constant.ADDED_MESSAGE'));
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //  No need to show i.e View Page
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $meta = Meta::findOrFail($id);
        //dd($meta);

        return view('admin.meta.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!is_null($return = $this->checkValidation()))
            return $return;
        $meta = Meta::findOrFail($id);
        $meta->website_title = $request->website_title;
        $meta->meta_title = $request->meta_title;
        $meta->meta_keyword = $request->meta_keyword;
        $meta->meta_description = $request->meta_description;
        $meta->url = $request->page_url;

        if ($meta->save()) {
            return redirect()->route('meta.index')->with('success', 'Meta '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('meta.create')->with('err_msg', ' '.Config::get('constant.TRY_MESSAGE'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $meta = Meta::findOrFail($id);
        if ($meta->forceDelete())
            return redirect()->route('meta.index')->with('success', 'Meta '.Config::get('constant.DELETE_MESSAGE'));
    }

}
