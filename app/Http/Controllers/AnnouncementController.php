<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Award;
use FFMpeg\FFMpeg;
use Illuminate\Http\Request;
//use FFMpeg\FFMpeg;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::orderBy('created_at','desc')->get();
        return view('Epm.Announcements.index',compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Epm.Announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_announcement = new Announcement();
        $new_announcement->title = $request->title;
        $new_announcement->link = $request->link;
        $new_announcement->description = $request->description;
        $fileName = '';
        $fileUrl = '';
        if ($request->hasFile('image_video')){

            $file = $request->file('image_video');
            $fileName = $file->getClientOriginalName();
//            if(preg_match('/^.*\.(mp4|mov|mpg|mpeg|wmv|mkv)$/i', $fileName)) {
//                $ffmpeg = new FFMpeg();
//                $video = $ffmpeg->open($fileName);
//                dd($video);
//                $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1));
//                dd($frame);
//                $frame->save($thumbnail);
//            }else{
//                $path = $file->move('Announcement/image_videos',$fileName);
//            }
            $path = $file->move('Announcement/image_videos',$fileName);
            $fileUrl = url("/")."/".$path->getPathname();
        }
        $new_announcement->image_video = $fileName;
        $new_announcement->image_video_url = $fileUrl;
        $new_announcement->save();
        return redirect('/adm/main/dashboard/#announcements')->with("success","New Announcement Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
