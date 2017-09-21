<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\StoreLanguage;
use DB;
use Config;
use App\Http\Controllers\Admin\AdminController;

class StoreLanguageController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'lang_name',1 => 'iso_631_1_code'));
        $this->setFormValidator($request, [
            'lang_name' => 'required|unique:store_language,lang_name',
            'iso_631_1_code' => 'required|unique:store_language,iso_631_1_code',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        /* @var $storeLanguageList type */
        $storeLanguageList = StoreLanguage::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.storeLanguage.index', compact('storeLanguageList', 'placeholder_string'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.storeLanguage.create');
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
        $storeLanguage = new StoreLanguage;
        $storeLanguage->lang_name = $request->lang_name;
        $storeLanguage->iso_631_1_code  = $request->iso_631_1_code;
    
        if ($storeLanguage->save())
            return redirect()->route('storeLanguage.index');
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
        $storeLanguage = StoreLanguage::findOrFail($id);

        return view('admin.storeLanguage.edit', compact('storeLanguage'));
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
        $storeLanguage = StoreLanguage::findOrFail($id);
        $storeLanguage->lang_name = $request->lang_name;
        $storeLanguage->iso_631_1_code = $request->iso_631_1_code;

        if ($storeLanguage->save()) {
            return redirect()->route('storeLanguage.index');
        } else {
            return redirect()->route('storeLanguage.create');
        }
    }
    public function storeLanguageSearch(Request $request) {
       
        if (empty($request->input('q')))
            return redirect()->route('storeLanguage.index');
        $q = $request->input('q');
        $placeholder_string = $this->getSearchPlaceholder();
        $storeLanguageList = DB::table('store_language')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);
        $pagination = $storeLanguageList->appends(array('q' => $q));
        return view('admin.storeLanguage.index', compact('storeLanguageList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $storeLanguage = StoreLanguage::findOrFail($id);
        $storeLanguage->delete();
        return redirect()->route('storeLanguage.index');
    }
}
