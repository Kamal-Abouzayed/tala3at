<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::all();
        return \view('dashboard.stories.index', \compact('stories'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();
        return \view('dashboard.stories.create', \compact('governorates'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $story = $this->validate($request, [
            'title'          => 'required|string|max:255',
            'type'           => 'required',
            'description'    => 'required|string',
            'image'          => 'required|image|dimensions:min_width=1238,min_height=646',
            'date'           => 'required',
            'time'           => 'required',
            'attendees'      => 'required',
            'governorate_id' => 'required',
            'city_id'        => 'required',
        ]);

        $story = new Story();
        $story->title = $request->title;
        $story->type = $request->type;
        $story->description = $request->description;
        if ($request->hasFile('image')) {
            $imageName = \time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }
        $story->image = $imageName;
        $story->date = Carbon::parse($request->date);
        $story->time = $request->time;
        $story->attendees = $request->attendees;
        $story->user_id = \auth()->user()->id;
        $story->governorate_id = $request->governorate_id;
        $story->city_id = $request->city_id;

        $story->save();

        return \redirect(\route('stories.index'))->with('success' , __('messages.story_created'));
    }

    public function getCityList(Request $request)
    {
        $govern_id = $request->governorate_id;
        $cities = City::where('governorate_id', $govern_id)->get();
        return response()->json([
            'cities' => $cities
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $story = Story::find($id);
        return view('dashboard.stories.edit', \compact('story'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $story = $this->validate($request, [
            'title'          => 'sometimes|required|string|max:255',
            'type'           => 'sometimes|required',
            'description'    => 'sometimes|required|string|max:255',
            'image'          => 'sometimes|required|image|max:1024',
            'date'           => 'sometimes|required',
            'time'           => 'sometimes|required',
            'attendees'      => 'sometimes|required',
            'governorate_id' => 'sometimes|required',
            'city_id'        => 'sometimes|required',
        ]);

        $story = Story::find($id);
        $story->title = $request->title;
        $story->type = $request->type;
        $story->description = $request->description;
        if ($request->hasFile('image')) {
            $imageName = \time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $story->image = $imageName;
        }
        $story->date = Carbon::parse($request->date);
        $story->time = $request->time;
        $story->attendees = $request->attendees;
        $story->user_id = \auth()->user()->id;
        $story->governorate_id = $request->governorate_id;
        $story->city_id = $request->city_id;

        $story->update();
        return \redirect(\route('stories.index'))->with('success' , __('messages.story_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);

        $image_path = public_path('images').'/'.$story->image;

        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $story->delete();

        return \redirect(\route('stories.index'))->with('success' , __('messages.story_deleted'));
    }
}
