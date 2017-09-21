<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Config;
use App\Currency;
use App\Http\Controllers\Admin\AdminController;

class CurrencyController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'lable', 1 => 'code'));
        $this->setFormValidator($request, [
            'lable' => 'required',
            'code' => 'required',
            'simbol' => 'required',
            'default_currency' => 'required',
        ]);
    }

    /**
     * Display a listing of Currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $currencyList = Currency::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.currency.index', compact('currencyList', 'placeholder_string'));
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
        $currency->default_currency = $request->default_currency;

        if ($currency->save())
            return redirect()->route('currency.index')->with('success', 'Currency '.Config::get('ADDED_MESSAGE'));
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
        $currency->default_currency = $request->default_currency;

        if ($currency->save()) {
            return redirect()->route('currency.index')->with('success', 'Currency '.Config::get('UPDATE_MESSAGE'));
        } else {
            return redirect()->route('currency.create')->with('err_msg', 'Currency '.Config::get('TRY_MESSAGE'));
        }
    }

    public function currencySearch(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('currency.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $currencyList = DB::table('currency')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $currencyList->appends(array('q' => $q));

        return view('admin.currency.index', compact('currencyList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect()->route('currency.index')->with('success', 'Currency '.Config::get('DELETE_MESSAGE'));
    }
}