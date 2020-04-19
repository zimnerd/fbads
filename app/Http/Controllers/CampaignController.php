<?php

namespace App\Http\Controllers;

use App\Models\AdFormat;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Goal;
use App\Models\Interest;
use App\Models\MediaType;
use App\Models\Objective;
use App\Models\Status;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;

class CampaignController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        if (strpos($user->menuroles, 'admin')) {
            $campaigns = Campaign::withTrashed()->with('user')->with('status')->paginate(10);

            return view('dashboard.campaigns.admin_list', ['campaigns' => $campaigns]);
        } else {
            $campaigns = Campaign::with('user')->with('status')->where('user_id', '=', $user->getAuthIdentifier())->paginate(10);

        }

        return view('dashboard.campaigns.list_campaigns', ['campaigns' => $campaigns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $users = Users::all();
        $statuses = Status::all();
        $interests = Interest::all();
        $objectives = Objective::all();
        $goals = Goal::all();
        $formats = AdFormat::all();
        $categories = Category::all();
        $user = auth()->user();
        $isadmin = strpos($user->menuroles, 'admin');
        $selected = Status::where('name', 'pending')
            ->first()->id;

        return view('dashboard.campaigns.add_campaign',
            [
                'categories' => $categories,
                'statuses' => $statuses,
                'ad_formats' => $formats,
                'user' => $user,
                'isadmin' => $isadmin,
                'users' => $users,
                'selected' => $selected,
                'goals' => $goals,
                'objectives' => $objectives,
                'interests' => $interests,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'start' => 'required|date_format:Y-m-d',
            'name' => 'required|min:1|max:64',
            'location' => 'required',
            'media_type' => 'required',
            'budget' => 'required',
            'gender' => 'required',
            'ad_period' => 'required',
            'goal_id' => 'required',
            'category_id' => 'required',
            'objective_id' => 'required',
            'age_range' => 'required',
            'interest_id' => 'required',


        ]);
        $user = auth()->user();
        $pendingStatus = Status::where('name', 'pending')
            ->first()->id;
        $mediType = MediaType::where('name', $request->input('media_type'))
            ->first()->id;
        $campaign = new Campaign();
        $campaign->name = $request->input('name');
        $campaign->category_id = $request->input('category_id');
        $campaign->goal_id = $request->input('goal_id');
        $campaign->objective_id = $request->input('objective_id');
        $campaign->start = $request->input('start');
        $campaign->radius = ($request->input('radius')== null)?0:$request->input('radius');
        $campaign->location = $request->input('location');
        $campaign->location_metadata = json_encode([
            "locality" => $request->input('locality'),
            "administrative_area_level_1" => $request->input('administrative_area_level_1'),
            "postal_code" => $request->input('postal_code'),
            "country" => $request->input('country'),
            "address_latitude" => $request->input('address_latitude'),
            "address_longitude" => $request->input('address_longitude'),
            "street_number" => $request->input('street_number')
        ]);
        $campaign->gender = $request->input('gender');
        $campaign->age_range = $request->input('age_range');
        $campaign->media_type_id = $mediType;
        $campaign->budget = $request->input('budget');
        $campaign->interest_id = $request->input('interest_id');
        $campaign->ad_period = $request->input('ad_period');
        $campaign->status_id = $pendingStatus;
        $campaign->user_id = $user->id;
        $campaign->save();

        if($campaign->creative){
            return redirect('/creatives/'.$campaign->creative->id.'/edit')->with('success', 'Successfully edited the campaign, Edit creative now');
        }
        else{
            return redirect('/creatives/create?id=' . $campaign->id)->with('success', 'Successfully created a campaign, add creative now');
        }

        //return redirect()->route('campaigns.index')->with('success', 'Successfully created campaign');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id,$capture=null)
    {
        $capture = ($capture == "capture");
        $users = Users::all();
        $user = auth()->user();
        $isadmin = strpos($user->menuroles, 'admin');
        $campaign = Campaign::withTrashed()->with('user')->with('status')->find($id);

        Log::info("Capture: ".$capture);
        return view('dashboard.campaigns.view_campaign', [
            'campaign' => $campaign,
            'isadmin' => $isadmin,
            'users' => $users,
            'capture' => $capture
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $campaign = Campaign::withTrashed()->find($id);
        $users = Users::all();
        $statuses = Status::all();
        $interests = Interest::all();
        $objectives = Objective::all();
        $goals = Goal::all();
        $formats = AdFormat::all();
        $categories = Category::all();
        $user = auth()->user();
        $isadmin = strpos($user->menuroles, 'admin');
        $selected = Status::where('name', 'pending')
            ->first()->id;

        return view('dashboard.campaigns.edit_campaign',
            ['categories' => $categories,
                'statuses' => $statuses,
                'ad_formats' => $formats,
                'user' => $user,
                'isadmin' => $isadmin,
                'users' => $users,
                'selected' => $selected,
                'goals' => $goals,
                'objectives' => $objectives,
                'interests' => $interests,
                'campaign' => $campaign]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'start' => 'required|date_format:Y-m-d',
            'name' => 'required|min:1|max:64',
            'location' => 'required',
            'media_type' => 'required',
            'budget' => 'required',
            'gender' => 'required',
            'ad_period' => 'required',
            'goal_id' => 'required',
            'category_id' => 'required',
            'objective_id' => 'required',
            'age_range' => 'required',
            'interest_id' => 'required',

        ]);
        $user = auth()->user();
        $pendingStatus = Status::where('name', 'pending')
            ->first()->id;
        $mediType = MediaType::where('name', $request->input('media_type'))
            ->first()->id;

        $campaign = Campaign::withTrashed()->find($id);
        $campaign->name = $request->input('name');
        $campaign->category_id = $request->input('category_id');
        $campaign->goal_id = $request->input('goal_id');
        $campaign->objective_id = $request->input('objective_id');
        $campaign->start = $request->input('start');
        $campaign->radius = ($request->input('radius')== null)?0:$request->input('radius');
        $campaign->location = $request->input('location');
        $campaign->location_metadata = json_encode([
            "locality" => $request->input('locality'),
            "administrative_area_level_1" => $request->input('administrative_area_level_1'),
            "postal_code" => $request->input('postal_code'),
            "country" => $request->input('country'),
            "address_latitude" => $request->input('address_latitude'),
            "address_longitude" => $request->input('address_longitude'),
            "street_number" => $request->input('street_number')
        ]);
        $campaign->gender = $request->input('gender');
        $campaign->age_range = $request->input('age_range');
        $campaign->media_type_id = $mediType;
        $campaign->budget = $request->input('budget');
        $campaign->interest_id = $request->input('interest_id');
        $campaign->ad_period = $request->input('ad_period');
        $campaign->status_id = $pendingStatus;
        $campaign->deleted_at = NULL;
        $campaign->save();
        $request->session()->flash('message', 'Successfully edited campaign');
        if($campaign->creative){
            return redirect('/creatives/'.$campaign->creative->id.'/edit')->with('success', 'Successfully edited the campaign, Edit creative now');
        }
        else{
            return redirect('/creatives/create?id=' . $campaign->id)->with('success', 'Successfully edited a campaign, add creative now');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit_status($id, $status,$reason='')
    {
        $campaign = Campaign::withTrashed()->find($id);
        if ($campaign) {
            $data = [
                'status_id' => Status::where('name', $status)->first()->id,
                'updated_at' => Carbon::now(),
                'deleted_at' => NULL
            ];
            DB::table('campaigns')
                ->where('id', $id)
                ->update($data);
        }

        if($campaign->creative){
            $creative = $campaign->creative;
            if($status=="ongoing"){
                $creative->ready = 1;
                $creative->active = 1;
                $creative->save();
            }
            if($status=="ready"){
                $creative->ready = 1;
                $creative->save();
            }
            if(in_array($status,['paused','stopped'])){
                $creative->active = 0;
                $creative->save();
            }
            if($status=='rejected'){
                $creative->active = 0;
                $creative->save();
            }
            if($status=="stopped"){
                $creative->finished = 1;
                $creative->save();
            }
        }


        return redirect()->route('campaigns.index')->with('success', 'Successfully edited campaign');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $campaign = Campaign::withTrashed()->find($id);
        if ($campaign) {
            $data = [
                'status_id' => Status::where('name', 'deleted')->first()->id,
                'updated_at' => Carbon::now()
            ];
            DB::table('campaigns')
                ->where('id', $id)
                ->update($data);
            $campaign->delete();
        }

        return redirect()->route('campaigns.index');
    }

    public function download($path)
    {
        return Storage::download($path);
    }

    public function downloadPDF($id)
    {
        $users = Users::all();
        $user = auth()->user();
        $isadmin = strpos($user->menuroles, 'admin');
        $campaign = Campaign::withTrashed()->with('user')->with('status')->find($id);

        $pdf = PDF::loadView('dashboard.campaigns.download_campaign', [
            'campaign' => $campaign,
            'isadmin' => $isadmin,
            'users' => $users
        ]);

        return $pdf->download($campaign->name . '_campaign.pdf');
    }
}
