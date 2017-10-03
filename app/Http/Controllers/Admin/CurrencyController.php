<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Config;
use App\Currency;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\DB;

class CurrencyController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'lable', 1 => 'code'));
        $this->setFormValidator($request, [
            'lable' => 'required',
            'code' => 'required',
            'simbol' => 'required',
//            'default_currency' => 'required',
        ]);
    }

    /**
     * Display a listing of Currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $currencyList = Currency::whereNull('deleted_at')->paginate(5);
//        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.currency.index', compact('currencyList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.currency.create');
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
        $currency = new Currency;
        $currency->lable = $request->lable;
        $currency->code = $request->code;
        $currency->simbol = $request->simbol;
        $currency->default_currency = 1;
//        if( $request->default_currency == 1 )
//        {
//            DB::table('currency')->update(array('default_currency' => 0));
//        }
        
        if ($currency->save())
            return redirect()->route('currency.index')->with('success', 'Currency '.Config::get('constant.ADDED_MESSAGE'));
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
        $currency = Currency::findOrFail($id);
        //echo "<pre>";        print_r($currency); die;
        return view('admin.currency.edit', compact('currency'));
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
        $currency = Currency::findOrFail($id);
         
        $currency->lable = $request->lable;
        $currency->code = $request->code;
        $currency->simbol = $request->simbol;
        $currency->default_currency = 1;
//        if($currency->default_currency != $request->default_currency)
//        {
//            if( $request->default_currency == 1 )
//            {
//                DB::table('currency')->update(array('default_currency' => 0));
//            }
//        }

        if ($currency->save()) {
            return redirect()->route('currency.index')->with('success', 'Currency '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('currency.create')->with('err_msg', ''.Config::get('constant.TRY_MESSAGE'));
        }
    }

    public function currencySearch(Request $request) {
//        dd($request);
        $query = '';
        if(isset($request->q))
            $query = $request->q;
        $currencyList = Currency::where("lable","like","%{$query}%")->orWhere("code","like","%{$query}%")->orWhere("simbol","like","%{$query}%")->latest('created_at')->paginate(50);
//        dd($currencyList);
        return view('admin.currency.index', compact('currencyList', 'query'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $currency = Currency::findOrFail($id);
        $currency->forceDelete();
        return redirect()->route('currency.index')->with('success', 'Currency '.Config::get('constant.DELETE_MESSAGE'));
    }
}