<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Settings;
use DB;
use App\Http\Controllers\Admin\AdminController;

class SettingsController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'key', 1 => 'value'));
        $this->setFormValidator($request, [
            'key' => 'required',
            'value' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $settingsList = Settings::whereNull('deleted_at')->paginate(5);
        $settingsList = Settings::orderBy('id', 'DESC')->paginate(2);
        // $placeholder_string = $this->getSearchPlaceholder();
        //return view('admin.setting.index', compact('settingsList', 'placeholder_string'));
    }

    public function readSettingXML(Request $request) {
        $xml = simplexml_load_file('file:///' . str_replace('\\', '/', public_path('system.xml')), null, LIBXML_NOCDATA);
        if ($xml) {
            return view('admin.settings.create', compact('xml'));
        }
    }

    public function create() {
        return view('admin.settings.create');
    }

    public function store(Request $request) {
        
        $config = $request->all();
        unset($config['createSettings']);
        unset($config['_token']);
        
        foreach($config as $tab => $sections){
            foreach((array)$sections as $section => $fields){
                foreach ((array)$fields as $field => $value)
                {
                        $isAvail = (bool) Settings::Where('key', $tab.'+++'.$section.'+++'.$field)->first();
                        if (!$isAvail) {
                            DB::table('settings')
                                    ->insert(array('key' => $tab.'+++'.$section.'+++'.$field, 'value' => is_array($value)?json_encode($value):$value));
                        } else {
                            DB::table('settings')
                                    ->where('key', '=', $tab.'+++'.$section.'+++'.$field)
                                    ->update(array('value' => is_array($value)?json_encode($value):$value));
                        }
                }
            }
            
        }
        
        
          return redirect()->route('settings.readSettingData');
    }

}
