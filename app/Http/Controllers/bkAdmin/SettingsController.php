<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Settings;
use DB;
use Config;
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

        foreach ($config as $tab => $sections) {
            foreach ((array) $sections as $section => $fields) {
                foreach ((array) $fields as $field => $value) {
                    $value = (array) $value;
                    foreach ($value as $k => $val) {

                        $key = (is_numeric($k)) ? $tab . '+++' . $section . '+++' . $field : $tab . '+++' . $section . '+++' . $field . '+++' . $k;

                        //$isAvail = (bool) Settings::Where('key', $key)->first();
                        $isAvail = DB::table('settings')->where('key', '=', $key)->first();
                        if (!$isAvail) {
                         
                            DB::table('settings')
                                    ->insert(array('key' => $key, 'value' => $val));
                        } else {
                          
                            DB::table('settings')
                                    ->where('key', '=', $key)
                                    ->update(array('value' => $val));
                        }
                    }
                }
            }
        }


        return redirect()->route('readSettingData')->with('success', 'Settings '.Config::get('constant.UPDATE_MESSAGE'));
    }

}
