<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Emailtemplate;
use Validator;
use Redirect;
use Route;
use Config;
use DB;
use App\Http\Controllers\Admin\AdminController;

class EmailtemplateController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'title', 1 => 'subject'));
        $this->setFormValidator($request, [
            'title' => 'required',
            'subject' => 'required',
            'content' => 'required',
            'macros' => 'required',
        ]);
    }

    public function index() {
        $emailtemplates = Emailtemplate::where('is_deleted', '=', '0')->paginate(5);
        // dd($emailtemplates);
        // $emailtemplates->setPath('emailtemplate');
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.emailtemplate.index', compact('emailtemplates', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.emailtemplate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //$messages = array( 'name.unique' => 'This name already exists' );

        if (!is_null($return = $this->checkValidation()))
            return $return;

        $emailtemplate = new Emailtemplate;
        $emailtemplate->title = $request->title;
        $emailtemplate->keyword = $request->keyword;
        $emailtemplate->subject = $request->subject;
        $emailtemplate->content = $request->content;
        $emailtemplate->macros = $request->macros;
        if ($emailtemplate->save()) {
            $request->session()->flash('success', 'Email Template Created Successfully.');
            // return back();
            return view('admin.emailtemplate.index');
        } else {
            $request->session()->flash('failure', 'Something Went Wrong!!!.');
            return view('admin.emailtemplate.index');
            // return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $emailtemplate = Emailtemplate::find($id);
        return view('admin.emailtemplate.edit', compact('emailtemplate'));
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

        $emailtemplate_data = array(
            'title' => $request->get('title'),
            'subject' => $request->get('subject'),
            'content' => $request->get('content'),
            'macros' => $request->get('macros'),
        );

        if (Emailtemplate::Where('id', $id)->update($emailtemplate_data)) {
            return redirect('admin/emailtemplate/')->with('success', 'Emailtemplate was successfully updated.');
        } else {
            return Redirect::route('admin/emailtemplate/')->withInput()->with('error', 'There was an issue updating the Emailtemplate. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function searchEmailtemplate(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('emailtemplate.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $emailtemplates = DB::table('emailtemplate')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $emailtemplates->appends(array('q' => $q));
        return view('admin.emailtemplate.index', compact('emailtemplates', 'q', 'placeholder_string'));
    }

}
