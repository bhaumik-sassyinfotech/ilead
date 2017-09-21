<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Messages;
use DB;
use Config;
use App\Http\Controllers\Admin\AdminController;

class MessagesController extends AdminController {

     public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'identifier'));
        $this->setFormValidator($request, [
            'identifier' => 'required|unique:messages,identifier|regex:/^[A-Za-z._-]+$/',
            'content' => 'required',         
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $messagesList = Messages::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.messages.index', compact('messagesList', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.messages.create');
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
        $messages = new Messages;
        $messages->identifier = $request->identifier;
        $messages->content = $request->content;
    
        if ($messages->save())
            return redirect()->route('messages.index')->with('success', 'Messages '.Config::get('constant.ADDED_MESSAGE'));
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
        $messages = Messages::findOrFail($id);

        return view('admin.messages.edit', compact('messages'));
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
        $messages = Messages::findOrFail($id);
        $messages->content = $request->content;

        if ($messages->save()) {
            return redirect()->route('messages.index')->with('success', 'Messages '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('messages.create')->with('err_msg', 'Messages '.Config::get('constant.TRY_MESSAGE'));
        }
    }
    public function messagesSearch(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('messages.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $messagesList = DB::table('messages')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $messagesList->appends(array('q' => $q));

        return view('admin.messages.index', compact('messagesList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $messages = Messages::findOrFail($id);
        $messages->forceDelete();
        return redirect()->route('messages.index')->with('success', 'Messages '.Config::get('constant.DELETE_MESSAGE'));
    }
}
