<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Faqmodule;
use App\Faqcategorys;
use DB;
use Config;
use Auth;
use App\Http\Controllers\Admin\AdminController;

class FaqmoduleController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'question', 1 => 'answer'));
        $this->setFormValidator($request, [
            'cat_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $faqmoduleList = Faqmodule::whereNull('deleted_at')->paginate(5);
        $faqcategoryList = Faqcategorys::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.faqmodule.index', compact('faqmoduleList', 'faqcategoryList', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $faqcategoryList = Faqcategorys::whereNull('deleted_at')->paginate(5);
        return view('admin.faqmodule.create', compact('faqcategoryList'));
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
        $faqmodule = new Faqmodule;
        $faqmodule->cat_id = $request->cat_id;
        $faqmodule->question = $request->question;
        $faqmodule->answer = $request->answer;

        if ($faqmodule->save())
            return redirect()->route('faqmodule.index')->with('success', 'Messages '.Config::get('constant.ADDED_MESSAGE'));
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
        $faqcategoryList = Faqcategorys::whereNull('deleted_at')->paginate(5);
        $faqmodule = Faqmodule::findOrFail($id);

        return view('admin.faqmodule.edit', compact('faqmodule', 'faqcategoryList'));
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
        $faqmodule = Faqmodule::findOrFail($id);
        $faqmodule->cat_id = $request->cat_id;
        $faqmodule->question = $request->question;
        $faqmodule->answer = $request->answer;
        if ($faqmodule->save()) {
            return redirect()->route('faqmodule.index')->with('success', 'FAQ Module '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('faqmodule.create')->with('err_msg', 'FAQ Module '.Config::get('constant.TRY_MESSAGE'));
        }
    }

    public function faqmoduleSearch(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('faqmodule.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $faqmoduleList = DB::table('faqmodule')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $faqmoduleList->appends(array('q' => $q));

        return view('admin.faqmodule.index', compact('faqmoduleList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $faqmodule = Faqmodule::findOrFail($id);
        $faqmodule->forceDelete();
        return redirect()->route('faqmodule.index')->with('success', 'FAQ Module '.Config::get('constant.DELETE_MESSAGE'));
    }

}
