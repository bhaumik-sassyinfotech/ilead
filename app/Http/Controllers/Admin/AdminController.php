<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Meta;
use DB;
use Config;
use App\Cms;
use App\User;
use Validator;
use Redirect;
use Auth;
use Illuminate\Routing\Controller;

class AdminController extends Controller {
    
    protected $searchArray = array();
    protected $validator = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        //$this->middleware('auth');
    }

    public function setSearchArray($fields = array()) {
        if (!empty($fields) && is_array($fields))
            $this->searchArray = $fields;
        else
            throw new Exception("Fields must be an array with proper value. with numerical index.", 1);
    }

    public function getSearchArray() {
        if (!empty($this->searchArray))
            return $this->searchArray;
        else
            throw new Exception("Fields has not been set.", 1);
    }

    public function createSearchQuery($searchValue = '') {
        $fields = $this->getSearchArray();

        if (empty($searchValue))
            throw new Exception("Search value must be with value.", 1);
        $r = 0;
        $que = "";
        $searchValue = explode(' ', trim($searchValue));
        foreach ($searchValue as $qarray) {
            if ($r == 0) {
                $que = '(';
            } else {
                $que .= 'AND (';
            }

            foreach ($fields as $i => $field) {
                if ($i > 0) {
                    $que .= " OR ";
                }
                $que .= $field . " LIKE '%" . $qarray . "%'";
            }
            $que .= ')';
            $r++;
        }
        return $que;
    }

    public function getSearchPlaceholder() {
        $my_placeholder = implode(', ', $this->getSearchArray());
        return "Search for " . str_replace('_', ' ', $my_placeholder);
        // return "Search for ".implode(', ',$this->getSearchArray());
    }

    public function setFormValidator($request, $validator = array()) {
        if (empty($validator) && !is_array($validator))
            throw new Exception("Validator value must be with array.", 1);

        $this->validator = Validator::make($request->all(), $validator);
    }

    public function checkValidation() {
        if ($this->validator->fails()) {
            return \Redirect::back()->withErrors($this->validator)->withInput();
        }
        return null;
    }

}
