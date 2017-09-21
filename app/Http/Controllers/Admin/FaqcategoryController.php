<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Faqcategorys;
use App\Meta;
use DB;
use Config;
use Auth;
use App\Http\Controllers\Admin\AdminController;

class FaqcategoryController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'title', 1 => 'keyword'));
           $this->setFormValidator($request, [
                'title' => 'required',
                'status' => 'required',
                'keyword' => 'required|unique:faqcategorys,keyword',
            ]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $faqcategorysList = Faqcategorys::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.faqcategorys.index', compact('faqcategorysList', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.faqcategorys.create');
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
        $faqcategorys = new Faqcategorys;
        $faqcategorys->title = $request->title;
        $faqcategorys->keyword = $request->keyword;
        $faqcategorys->status = $request->status;

        if ($faqcategorys->save())
            return redirect()->route('faqcategorys.index')->with('success', 'Faq category '.Config::get('constant.ADDED_MESSAGE'));
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
        $faqcategorys = Faqcategorys::findOrFail($id);

        return view('admin.faqcategorys.edit', compact('faqcategorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
         $this->setFormValidator($request, [
                'title' => 'required',
                'status' => 'required',
                'keyword' => 'required',
            ]);
        if (!is_null($return = $this->checkValidation()))
            return $return;
        $faqcategorys = Faqcategorys::findOrFail($id);
        $faqcategorys->title = $request->title;
        $faqcategorys->keyword = $request->keyword;
        $faqcategorys->status = $request->status;
        if ($faqcategorys->save()) {
            return redirect()->route('faqcategorys.index')->with('success', 'Faq category '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('faqcategorys.create')->with('err_msg', 'Faq category '.Config::get('constant.TRY_MESSAGE'));
        }
    }

    public function faqcategorysSearch(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('faqcategorys.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $faqcategorysList = DB::table('faqcategorys')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $faqcategorysList->appends(array('q' => $q));

        return view('admin.faqcategorys.index', compact('faqcategorysList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $faqcategorys = Faqcategorys::findOrFail($id);
        $faqcategorys->forceDelete();
        return redirect()->route('faqcategorys.index')->with('success', 'Faq category '.Config::get('constant.DELETE_MESSAGE'));
    }

}
