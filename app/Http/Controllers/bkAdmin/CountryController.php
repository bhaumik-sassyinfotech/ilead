<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Country;
use Config;
use DB;
use App\Http\Controllers\Admin\AdminController;

class CountryController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'country_name',1 => 'a_2',2 => 'a_3'));
        $this->setFormValidator($request, [
            'country_name' => 'required',
            'a_2' => 'required',
            'a_3' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $countryList = Country::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.country.index', compact('countryList', 'placeholder_string'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.country.create');
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
        $country = new Country;
        $country->country_name = $request->country_name;
        $country->a_2 = $request->a_2;
        $country->a_3 = $request->a_3;
    
        if ($country->save())
            return redirect()->route('country.index')->with('success', 'Country '.Config::get('ADDED_MESSAGE'));
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
        $country = Country::findOrFail($id);

        return view('admin.country.edit', compact('country'));
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
        $country = Country::findOrFail($id);
        
        $country->country_name = $request->country_name;
        $country->a_2 = $request->a_2;
        $country->a_3 = $request->a_3;

        if ($country->save()) {
            return redirect()->route('country.index')->with('success', 'Country '.Config::get('UPDATE_MESSAGE'));
        } else {
            return redirect()->route('country.create')->with('err_msg', 'Country '.Config::get('TRY_MESSAGE'));;
        }
    }
    public function countrySearch(Request $request) {
       
        if (empty($request->input('q')))
            return redirect()->route('country.index');
        $q = $request->input('q');
        $placeholder_string = $this->getSearchPlaceholder();
        $countryList = DB::table('country')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);
        $pagination = $countryList->appends(array('q' => $q));
        return view('admin.country.index', compact('countryList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->route('country.index')->with('success', 'Country '.Config::get('DELETE_MESSAGE'));;
    }
}
