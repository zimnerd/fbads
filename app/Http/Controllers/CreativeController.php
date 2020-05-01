<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Mail\UserMail;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Creative;
use App\Models\Media;
use App\Models\Status;
use Faker\Provider\tr_TR\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $id = $request->input('id');
        $statuses = Status::all();
        $categories = Category::all();
        $campaign = Campaign::withTrashed()->find($id);
        $selected = Status::where('name', 'pending')
            ->first()->id;
        if ($campaign->creative)
        {
            return redirect('/creatives/' . $campaign->creative->id . '/edit')->with('success', 'Successfully edited the campaign, Edit creative now');
        }
        else
        {
            return view('dashboard.creatives.add_creative',
                [
                    'statuses' => $statuses,
                    'selected' => $selected,
                    'campaign' => $campaign,
                    'categories' => $categories,
                ]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Creative $creative, $action = NULL)
    {
        $id = $request->input('id');
        $statuses = Status::all();
        $categories = Category::all();
        $campaign = Campaign::withTrashed()->find($creative->campaign_id);
        $selected = Status::where('name', 'pending')
            ->first()->id;

        return view('dashboard.creatives.edit_creative',
            [
                'statuses' => $statuses,
                'selected' => $selected,
                'campaign' => $campaign,
                'creative' => $creative,
                'categories' => $categories,
                'action' => $action,
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
        $validatedData = $request->validate([
            'link' => 'required',
            'campaign_id' => 'required',
            'facebook_page' => 'required',
            'facebook_email' => 'required',
            'description' => 'required',
            'ad_media' => 'required',
            'title' => 'required'
        ]);


        $pendingStatus = Status::where('name', 'pending')
            ->first()->id;
        $creative = new Creative();
        $creative->link = $request->input('link');
        $creative->status_id = $pendingStatus;
        $creative->campaign_id = $request->input('campaign_id');
        $creative->facebook_page = $request->input('facebook_page');
        $creative->facebook_email = $request->input('facebook_email');
        $creative->reach = $request->input('reach');
        $creative->title = $request->input('title');
        $creative->description = $request->input('description');
        $creative->clicks = $request->input('clicks');
        $creative->landing_clicks = $request->input('landing_clicks');
        $creative->other_clicks = $request->input('other_clicks');
        $creative->setup = 1;
        $creative->frequency = $request->input('frequency');
        $creative->rejection_reason = $request->input('rejection_reason');
        $creative->comments = $request->input('comments');
        $creative->notes = $request->input('notes');
        $creative->video_views = $request->input('video_views');
        $creative->engagement_rate = $request->input('engagement_rate');
        $creative->save();


        $ad_media = $request->input('ad_media');

        foreach ($ad_media as $media_file)
        {

            $media = new Media();
            Log::info($media_file);
            $path_parts = pathinfo($media_file);
            $fileExt = $path_parts['extension'];
            $img_path = NULL;
            $video_path = NULL;
            if (in_array(strtolower($fileExt), ["jpg", "png", "jpeg", "gif"]))
            {
                $img_path = "files/uploads/" . $media_file;
            }
            if (in_array(strtolower($fileExt), ["avi", "mpg", "mp4", "mkv"]))
            {
                $video_path = "files/uploads/" . $media_file;
            }
            $media->name = $media_file;
            $media->link = config('app.url') . "/files/uploads/" . $media_file;;
            $media->image_path = $img_path;
            $media->video_path = $video_path;
            $media->creative_id = $creative->id;
            Log::info($media);
            $media->save();
        }
        $campaign = Campaign::withTrashed()->find($creative->campaign_id);
        $campaign->action = "new_ad";
        Mail::to(config('app.admin_email'))->send(new AdminMail($campaign));

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
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param Creative $creative
     *
     */


    public function update(Request $request, $id)
    {

        $creative = Creative::withTrashed()->find($id);
        $campaign = Campaign::withTrashed()->find($creative->campaign_id);
        $pendingReview = Status::where('name', 'pending review')->first()->id;
        $rejected = Status::where('name', 'rejected')->first()->id;
        $ongoing = Status::where('name', 'live')->first()->id;
        $pending = Status::where('name', 'pending')->first()->id;
        $action = $request->input('action');
        $comments = $request->input('comments');
        $rejection_reason = $request->input('rejection_reason');
        Log::info("COMMENTS: " . $comments);
        if ($action == 'submit_for_review')
        {
            $ad_media = $request->input('ss_media');
            foreach ($ad_media as $media_file)
            {
                Media::whereNotNull('screenshot_path')->where('creative_id', $id)->delete();

                $media = new Media();
                Log::info($media_file);
                $path_parts = pathinfo($media_file);
                $fileExt = $path_parts['extension'];
                $img_path = NULL;
                $video_path = NULL;
                $screenshot_path = $img_path = "files/uploads/" . $media_file;;
                $media->name = $media_file;
                $media->link = config('app.url') . "/files/uploads/" . $media_file;;
                $media->image_path = $img_path;
                $media->video_path = $video_path;
                $media->screenshot_path = $screenshot_path;
                $media->creative_id = $id;
                Log::info($media);
                $media->save();

            }
            $campaign->status_id = $pendingReview;
            $campaign->save();
            $campaign->action = "submit_for_review";
            Mail::to($campaign->user->email)->send(new UserMail($campaign));

            return redirect('/campaigns/' . $request->input('campaign_id'))->with('success', 'Successfully updated a creative');
        }

        if ($comments !== NULL)
        {
            $creative->comments = $request->input('comments');
            $creative->save();
            $campaign->status_id = $pending;
            $campaign->save();
            $campaign->action = "comments";
            Mail::to(config('app.admin_email'))->send(new AdminMail($campaign));

            return redirect('/campaigns/' . $request->input('campaign_id'))->with('success', 'Successfully submitted comment');
        }


        if ($rejection_reason !== NULL)
        {
            $creative->rejection_reason = $request->input('rejection_reason');
            $creative->status_id = $rejected;;
            $creative->save();
            $campaign->status_id = $rejected;
            $campaign->save();
            $campaign->action = "rejection_reason";
            Mail::to($campaign->user->email)->send(new UserMail($campaign));

            return redirect('/campaigns')->with('success', 'Successfully rejected');
        }

        Log::info($request);
        Log::info($request->input());
        $pendingStatus = Status::where('name', 'pending')->first()->id;
        $creative->link = $request->input('link');
        $creative->status_id = $pendingStatus;
        $creative->campaign_id = $request->input('campaign_id');
        $creative->facebook_page = $request->input('facebook_page');
        $creative->facebook_email = $request->input('facebook_email');
        $creative->setup = 1;
        $creative->notes = $request->input('notes');
        $creative->title = $request->input('title');
        $creative->description = $request->input('description');
        $creative->save();
        $ad_media = $request->input('ad_media');
        if ($ad_media)
        {
            foreach ($ad_media as $media_file)
            {
                $mediaExist = Media::where('name', $media_file)->where('creative_id', $id)->first();
                if ($mediaExist)
                {

                }
                else
                {
                    $media = new Media();
                    Log::info($media_file);
                    $path_parts = pathinfo($media_file);
                    $fileExt = $path_parts['extension'];
                    $img_path = NULL;
                    $video_path = NULL;
                    if (in_array(strtolower($fileExt), ["jpg", "png", "jpeg", "gif"]))
                    {
                        $img_path = "files/uploads/" . $media_file;
                    }
                    if (in_array(strtolower($fileExt), ["avi", "mpg", "mp4", "mkv"]))
                    {
                        $video_path = "files/uploads/" . $media_file;
                    }
                    $media->name = $media_file;
                    $media->link = config('app.url') . "/files/uploads/" . $media_file;;
                    $media->image_path = $img_path;
                    $media->video_path = $video_path;
                    $media->creative_id = $creative->id;
                    Log::info($media);
                    $media->save();
                }
            }
        }


        return redirect('/campaigns/' . $request->input('campaign_id'))->with('success', 'Successfully updated a creative');
    }


    public function storeMedia(Request $request)
    {

        $path = 'files/uploads';

        if (!file_exists($path))
        {
            mkdir($path, 0777, TRUE);
        }
        $file = $request->file('file');
        Log::info($file);

        $name = uniqid() . '_' . time() . "." . $file->getClientOriginalExtension();

        if ($file->move($path, $name))
        {
            Log::info("Moved");
        };

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function add_comment(Request $request, $id)
    {
        $creative = Creative::withTrashed()->find($id);
        $creative->comments = $request->input('comments');
        $creative->save();

        return response()->json([
            'id' => $id,
        ]);
    }


    public function request_review(Request $request, $id)
    {
        $creative = Creative::withTrashed()->find($id);
        $creative->save();

        return response()->json([
            'id' => $id,
        ]);
    }

    public function reject(Request $request, $id)
    {
        $creative = Creative::withTrashed()->find($id);
        $creative->rejection_reason = $request->input('rejection_reason');
        $creative->save();

        return response()->json([
            'id' => $id,
        ]);
    }

    public function getStoredMedia(Request $request, $id)
    {
        Log::info($request);
        Log::info($id);
//        $id = $request->input('id');
        $creative = Creative::withTrashed()->find($id);
        Log::info($creative);
        $result = [];
        $files = $creative->media;                 //1
        if (FALSE !== $files)
        {
            foreach ($files as $file)
            {
                Log::info($file);//2
                $obj['name'] = $file->name;
                $obj['url'] = $file->link;
                $file_path = ($file->image_path != NULL) ? $file->image_path : $file->video_path;
                $obj['size'] = filesize($file_path);
                $result[] = $obj;

            }
        }

        return response()->json($result);
    }

    public function getScreenshot(Request $request, $id)
    {
        Log::info($request);
        Log::info($id);
//        $id = $request->input('id');
        $creative = Creative::withTrashed()->find($id);
        Log::info($creative);
        $result = [];
        $files = $creative->media;
        $ss = Media::whereNotNull('screenshot_path')->where('creative_id', $id)->first();
        Log::info($ss);//2
        if ($ss)
        {
            Log::info($ss);//2
            $obj['name'] = $ss->name;
            $obj['url'] = $ss->link;
            $file_path = $ss->screenshot_path;
            $obj['size'] = filesize($file_path);
            $result[] = $obj;


        }

        return response()->json($result);
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
                'updated_at' => Carbon::now()
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

    public function delete_media(Request $request)
    {
        $input = $request->all();
        Log::info($input);
        Log::info($input['file_data']['name']);
        $filename = json_decode($input['file_data'])->name;
        $path = public_path() . '/files/uploads/' . $filename;
        if (file_exists($path))
        {
            unlink($path);
        }

        return response()->json([
            'name' => $filename,
            'status' => 'ok'
        ]);
    }

    public function delete_edit_media(Request $request)
    {
        $input = $request->all();
        Log::info($input);
        $filename = (isset($input['file_data']['name'])) ? $input['file_data']['name'] : json_decode($input['file_data'])->name;
        $media = Media::where('name', $filename)->first()->delete();
//        $path = public_path() . '/files/uploads/' . $filename;
//        if (file_exists($path)) {
//            unlink($path);
//        }
        return response()->json([
            'name' => $filename,
            'status' => 'ok'
        ]);
    }

}
