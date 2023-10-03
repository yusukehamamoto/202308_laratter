<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementRead;
use Illuminate\Http\Request;

class Announcementcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('announcement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Announcement $announcement)
    {
        $user = $request->user();
        $announcement_read = AnnouncementRead::where('user_id', $user->id)
            ->where('tweet', $announcement->id)
            ->first();

        if(!is_null($announcement_read)) {

            $announcement_read->read = true;
            $announcement_read->save();
        }

        return $announcement;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function list(Request $request) {

        $user = $request->user();
        return Announcement::whereHas('reads', function($query) use($user){

            $query->where('user_id', $user->id)
                ->where('read', false);

        })
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(7);

    }
}
