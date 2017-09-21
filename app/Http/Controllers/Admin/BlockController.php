<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Block;
use DB;
use Config;
use App\Http\Controllers\Admin\AdminController;

class BlockController extends AdminController {

    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'identifier'));
        $this->setFormValidator($request, [
            'identifier' => 'required|unique:blocks,identifier',
            'content' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $blockList = Block::whereNull('deleted_at')->paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.block.index', compact('blockList', 'placeholder_string'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.block.create');
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
        $block = new Block;
        $block->identifier = $request->identifier;
        $block->content = $request->content;
    
        if ($block->save())
            return redirect()->route('block.index')->with('success', 'Block '.Config::get('constant.ADDED_MESSAGE'));
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
        $block = Block::findOrFail($id);

        return view('admin.block.edit', compact('block'));
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
        $block = Block::findOrFail($id);
        
        $block->content = $request->content;

        if ($block->save()) {
            return redirect()->route('block.index')->with('success', 'Block '.Config::get('constant.UPDATE_MESSAGE'));
        } else {
            return redirect()->route('block.create')->with('err_msg', 'Block '.Config::get('constant.TRY_MESSAGE'));
        }
    }
    public function blockSearch(Request $request) {
       
        if (empty($request->input('q')))
            return redirect()->route('block.index');
        $q = $request->input('q');
        $placeholder_string = $this->getSearchPlaceholder();
        $blockList = DB::table('blocks')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);
        $pagination = $blockList->appends(array('q' => $q));
        return view('admin.block.index', compact('blockList', 'q', 'placeholder_string'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $block = Block::findOrFail($id);
        $block->forceDelete();
        return redirect()->route('block.index')->with('success', 'Block '.Config::get('constant.DELETE_MESSAGE'));;
    }
}
