<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Notification;
use App\Meta;
use Validator;
use DB;
use Config;
use Auth;
use App\Http\Controllers\Admin\AdminController;

class NotificationController extends AdminController {

     public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'identifier'));
        $this->setFormValidator($request, [
            'identifier' => 'required|unique:notifications,identifier|regex:/^[A-Za-z._-]+$/',
            'content' => 'required',         
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $notificationList = Notification::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.notification.index', compact('notificationList', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.notification.create');
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
        $notification = new Notification;
        $notification->identifier = $request->identifier;
        $notification->content = $request->content;
    
        if ($notification->save())
            return redirect()->route('notification.index')->with('success', 'Notification '.Config::get('ADDED_MESSAGE'));
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
        $notification = Notification::findOrFail($id);

        return view('admin.notification.edit', compact('notification'));
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
            'identifier' => 'required',
            'content' => 'required',         
        ]);
        if (!is_null($return = $this->checkValidation()))
            return $return;
        $notification = Notification::findOrFail($id);
        $notification->content = $request->content;

        if ($notification->save()) {
            return redirect()->route('notification.index')->with('success', 'Notification '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('notification.create')->with('err_msg', 'Notification '.Config::get('constant.TRY_MESSAGE'));
        }
    }
   

    public function notificationSearch(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('notification.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $notificationList = DB::table('notifications')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $notificationList->appends(array('q' => $q));

        return view('admin.notification.index', compact('notificationList', 'q', 'placeholder_string'));
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id) {
        $notification = Notification::findOrFail($id);
        $notification->forceDelete();
        return redirect()->route('notification.index')->with('success', 'Notification '.Config::get('constant.DELETE_MESSAGE'));
    }
}
