<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plans;
use Auth;
use Config;
use DB;
class PlansController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {        
        $this->middleware(function ($request, $next) {

            $permissions = json_decode(Auth::user()->role->permissions,true);
            
            if($permissions['users.view']=='true' && $request->is('plans')=='true')
                return $next($request);
            if($permissions['users.manage']=='true')
                return $next($request);
            else
                return response()->view('errors.503');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $plans = Plans::paginate(5);
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan                       = new Plans;
        $plan->name                 = $request->input('name');
        $plan->subscription_period  = $request->input('priceMon');
        $plan->subscription_perice  = $request->input('priceAnual');
        $plan->status               = ($request->input('status')=='true')?1:0;
        if($plan->save()){
            return redirect()->route('plans.index');
        }else{
            return redirect()->route('plans.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plans::findOrFail($id);

        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(Request $request, $id)
    {
        $plan = Plans::findOrFail($id);
        $plan->name                 = $request->input('name');
        $plan->subscription_period  = $request->input('priceMon');
        $plan->subscription_perice  = $request->input('priceAnual');
        $plan->status               = ($request->input('status')=='true')?1:0;
        
        if($plan->save()){
            return redirect()->route('plans.index');
        }else{
            return redirect()->route('plans.create');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plans::findOrFail($id);
        if($plan->forceDelete())
            return redirect()->route('plans.index');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request){
        if ($request->input('ids')) {
            $ids = $request->input('ids');
            $sucess = DB::table("plans")->whereIn('id',explode(",",$ids))->delete();
            return response()->json(['success'=>"Plans Deleted successfully."]);
        }
    }

    /**
     * Search Records.
     *
     * @param Request $request
     */
    public function searchPlans(Request $request){
		$q = $request->input( 'q' );
		$q_array = explode(" ",$q);
				
		$query = Plans::query();	
		$r = 0;	
		foreach($q_array as $qarray){
			if($r == 0){
				$query = $query->where('name', 'LIKE', '%'.$qarray.'%');
			}else{
				$query = $query->Where('name', 'LIKE', '%'.$qarray.'%');
			}
			$r++;
		}
		$plans = $query->paginate (5);		

        if($q != ""){
            $pagination = $plans->appends ( array ('q' => $request->input( 'q' ) ) );

            if (count ( $plans ) > 0)
                return view ( 'admin.plans.index',compact('plans','q'))->withQuery ( $q );
        }
        else{
            return redirect()->route('plans.index',compact('plans','q'));
        }
        return view ( 'admin.plans.index',compact('q'));
    }
}
