<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Creative;
use App\Models\Status;
use Faker\Provider\tr_TR\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CreativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $id = $request->input('id');;
        $statuses = Status::all();
        $categories = Category::all();
        $campaign = Campaign::withTrashed()->find($id);
        $selected = Status::where('name', 'pending')
            ->first()->id;

        return view('dashboard.creatives.add_creative',
            [
                'statuses' => $statuses,
                'selected' => $selected,
                'campaign' => $campaign,
                'categories' => $categories,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $path = '';
        $file_type = '';
        if ($request->hasFile('video_path'))
        {
            $path = 'files/videos';
            $file_type = 'videos';
            $validatedData = $request->validate([
                'name' => 'required|min:1|max:64',
                'title' => 'required',
                'link' => 'required',
                'campaign_id' => 'required',
                'vid_type' => 'required',
                'status_id' => 'required',
                'video_path' => 'required|mimes:mp4,mpeg,flv,wmv,mov,avi|max:10000'
            ]);

            $file = $request->file('video_path');

            $name = $request->input('name') . time() . '.' . $file->getClientOriginalExtension();

            // $target_path = $path;
            $path = $request->video_path->store($path, 'public');


        }
        elseif ($request->hasFile('image_path'))
        {
            $file_type = 'images';
            $path = 'files/images';
            $validatedData = $request->validate([
                'name' => 'required|min:1|max:64',
                'title' => 'required',
                'link' => 'required',
                'campaign_id' => 'required',
                'status_id' => 'required',
                'image_path' => 'required|mimes:jpeg,png,jpg,bmp|max:4096'
            ]);

            $file = $request->file('image_path');
            $name = $request->input('name') . time() . '.' . $file->getClientOriginalExtension();
            $path = $request->image_path->store($path, 'public');

        }
        elseif ($request->input('vid_type') === 'video_link')
        {
            $path = NULL;
            $file_type = 'videos';
            $validatedData = $request->validate([
                'name' => 'required|min:1|max:64',
                'title' => 'required',
                'link' => 'required',
                'campaign_id' => 'required',
                'vid_type' => 'required',
                'status_id' => 'required',
                'video_link' => 'required'
            ]);


        }
        else
        {
            $path = public_path('/files/');
            $validatedData = $request->validate([
                'name' => 'required|min:1|max:64',
                'description' => 'required',
                'title' => 'required',
                'link' => 'required',
                'campaign_id' => 'required',
                'status_id' => 'required',
            ]);

        }
        $creative = new Creative();
        $creative->name = $request->input('name');
        $creative->title = $request->input('title');
        $creative->description = $request->input('description');
        $creative->advertiser = ($file_type === 'videos') ? $request->input('advertiser') : NULL;
        $creative->link = $request->input('link');
        $creative->ad_image_size = ($file_type === 'images') ? $request->input('ad_image_size') : NULL;
        $creative->type = ($file_type = 'images') ? $request->input('type') : NULL;
        $creative->image_path = ($file_type === 'images') ? $path : NULL;
        $creative->video_path = ($file_type === 'videos') ? $path : NULL;
        $creative->vid_type = $request->input('vid_type');
        $creative->video_link = $request->input('video_link');
        $creative->status_id = $request->input('status_id');
        $creative->campaign_id = $request->input('campaign_id');
        $creative->impressions = $request->input('impressions');
        $creative->clicks = $request->input('clicks');
        $creative->devices = $request->input('devices');
        $creative->supports = $request->input('supports');
        $creative->ctr = $request->input('ctr');
        $creative->average_bid = $request->input('average_bid');
        $creative->spend = $request->input('spend');
        $creative->conversion = $request->input('conversion');
        $creative->conversion_rate = $request->input('conversion_rate');
        $creative->CPA = $request->input('CPA');
        $creative->save();

        return redirect('/campaigns/' . $request->input('campaign_id'))->with('success', 'Successfully created a creative');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Creative $creative
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Creative $creative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Creative $creative
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Creative $creative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creative     $creative
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creative $creative)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Creative     $creative
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function live_update(Request $request, Creative $creative)
    {
        if ($request->ajax())
        {
            $data = [
                $request->column_name => $request->column_value
            ];
            DB::table('creatives')
                ->where('id', $request->id)
                ->update($data);

            $creative = Creative::find($request->id);
            $data = [
                'updated_at' =>  Carbon::now()
            ];
            DB::table('campaigns')
                ->where('id', $creative->campaign_id)
                ->update($data);
            echo '<div class="alert alert-success">' . $request->column_name . ' Data Updated to ' . $request->column_value . '</div > ';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Creative $creative
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creative $creative)
    {
        //
    }
}
