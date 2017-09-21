<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Plans;
use Auth;
use Config;
use DB;
use App\Http\Controllers\Admin\AdminController;

class PlansController extends AdminController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct(Request $request) {
        $this->setSearchArray(array(0 => 'name', 1 => 'subscription_period', 2 => 'subscription_perice'));
        $this->setFormValidator($request, [
            'name' => 'required|unique:plans,name',
            'priceMon' => 'required',
            'priceAnual' => 'required',
        ]);      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $plans = Plans::paginate(5);
        $placeholder_string = $this->getSearchPlaceholder();
        return view('admin.plans.index', compact('plans', 'placeholder_string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.plans.create');
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
        $plan = new Plans;
        $plan->name = $request->input('name');
        $plan->subscription_period = $request->input('priceMon');
        $plan->subscription_perice = $request->input('priceAnual');
        $plan->status = ($request->input('status') == 'true') ? 1 : 0;
        if ($plan->save()) {
            return redirect()->route('plans.index')->with('success', 'Plans '.Config::get('constant.constant.ADDED_MESSAGE'));
        } else {
            return redirect()->route('plans.create')->with('err_msg', ''.Config::get('constant.constant.TRY_MESSAGE'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $plan = Plans::findOrFail($id);

        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $plan = Plans::findOrFail($id);

        return view('admin.plans.edit', compact('plan'));
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
            'name' => 'required',
            'priceMon' => 'required',
            'priceAnual' => 'required',
        ]);
        if (!is_null($return = $this->checkValidation()))
            return $return;
        $plan = Plans::findOrFail($id);
        $plan->name = $request->input('name');
        $plan->subscription_period = $request->input('priceMon');
        $plan->subscription_perice = $request->input('priceAnual');
        $plan->status = ($request->input('status') == 'true') ? 1 : 0;

        if ($plan->save()) {
            return redirect()->route('plans.index')->with('success', 'Plans '.Config::get('constant.constant.ADDED_MESSAGE'));
        } else {
            return redirect()->route('plans.create')->with('err_msg', ''.Config::get('constant.constant.TRY_MESSAGE'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $plan = Plans::findOrFail($id);
        if ($plan->forceDelete())
            return redirect()->route('plans.index')->with('success', 'Plans '.Config::get('constant.constant.DELETE_MESSAGE'));
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request) {
        if ($request->input('ids')) {
            $ids = $request->input('ids');
            $sucess = DB::table("plans")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' => "Plans Deleted successfully."]);
        }
    }

    /**
     * Search Records.
     *
     * @param Request $request
     */
    
     public function searchPlans(Request $request) {
        if (empty($request->input('q')))
            return redirect()->route('plans.index');
        $q = $request->input('q');

        $placeholder_string = $this->getSearchPlaceholder();
        $plans = DB::table('plans')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);

        $pagination = $plans->appends(array('q' => $q));

        return view('admin.plans.index', compact('plans', 'q', 'placeholder_string'));
    }

   /* public function searchPlans(Request $request) {
        $q = $request->input('q');
        $q_array = explode(" ", $q);

        $query = Plans::query();
        $r = 0;
        foreach ($q_array as $qarray) {
            if ($r == 0) {
                $query = $query->where('name', 'LIKE', '%' . $qarray . '%');
            } else {
                $query = $query->Where('name', 'LIKE', '%' . $qarray . '%');
            }
            $r++;
        }
        $plans = $query->paginate(5);

        if ($q != "") {
            $pagination = $plans->appends(array('q' => $request->input('q')));

            if (count($plans) > 0)
                return view('admin.plans.index', compact('plans', 'q'))->withQuery($q);
        }
        else {
            return redirect()->route('plans.index', compact('plans', 'q'));
        }
        return view('admin.plans.index', compact('q'));
    }*/

}
