<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cms;
use Config;
use App\Meta;
use Validator;
use DB;
use Auth;
use App\Http\Controllers\Admin\AdminController;

class CmsController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'website_title', 1 => 'meta_title'));
        $this->setFormValidator($request, [
            'website_title' => 'required',
            'keyword' => 'required|unique:cms,keyword|regex:/^[A-Za-z._-]+$/',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'summernote' => 'required',
        ]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $cmsList = Cms::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.cms.index', compact('cmsList', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.cms.create');
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

        $cms = new Cms;
        $cms->website_title = $request->website_title;
        $cms->project = $request->project;
        $cms->keyword = $request->keyword;
        $cms->status = $request->status;
        $cms->meta_title = $request->meta_title;
        $cms->meta_keyword = $request->meta_keyword;
        $cms->meta_description = $request->meta_description;
        $cms->description = $request->summernote;

        if ($cms->save())
            return redirect()->route('cms.index')->with('success', 'CMS '.Config::get('ADDED_MESSAGE'));;
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
        $cms = Cms::findOrFail($id);

        return view('admin.cms.edit', compact('cms'));
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
        $cms = Cms::findOrFail($id);
        $cms->website_title = $request->website_title;
        $cms->project = $request->project;
         $cms->keyword = $request->keyword;
        $cms->status = $request->status;
        $cms->meta_title = $request->meta_title;
        $cms->meta_keyword = $request->meta_keyword;
        $cms->meta_description = $request->meta_description;
        $cms->description = $request->summernote;

        if ($cms->save()) {
            return redirect()->route('cms.index')->with('success', 'CMS '.Config::get('ADDED_MESSAGE'));;
        } else {
            return redirect()->route('cms.create')->with('success', 'CMS '.Config::get('TRY_MESSAGE'));;
        }
    }

    public function cmsSearch(Request $request) {
        dd($request->all());
        if (empty($request->input('q')))
            return redirect()->route('cms.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $cmsList = DB::table('cms')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $cmsList->appends(array('q' => $q));

        return view('admin.cms.index', compact('cmsList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
