<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('userid')) {
            $data = array(
                "notes" => DB::table('notes')
                    ->join('users', 'notes.user_id', '=', 'users.user_id')
                    ->select('notes.*', 'users.name', 'users.profile')
                    ->where('notes.user_id', session('userid'))
                    ->orderBy('created_at', 'desc')
                    ->paginate(8),
                "count" => DB::table('notes')
                    ->where('user_id', session('userid'))->count()
            );
        } else {
            $data = array(
                "notes" => DB::table('notes')
                    ->join('users', 'notes.user_id', '=', 'users.user_id')
                    ->select('notes.*', 'users.name', 'users.profile')
                    ->orderBy('created_at', 'desc')
                    ->paginate(8),
                "count" => DB::table('notes')->count()
            );
        }

        return view('notes.index', $data);
    }

    public function search(Request $request)
    {

        if (session()->has('userid')) {
            if ($request['search'] && !$request['search-color']) {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(8),
                    "count" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->count()
                );
            } elseif ($request['search-color'] && !$request['search']) {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->where('notes.color', $request['search-color'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(8),
                    "count" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->where('notes.color', $request['search-color'])
                        ->count()
                );
            } elseif ($request['search'] && $request['search-color']) {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->where('notes.color', $request['search-color'])
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->paginate(8),
                    "count" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->where('notes.color', $request['search-color'])
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->count()
                );
            } else {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.user_id', '=', session('userid'))
                        ->orderBy('created_at', 'desc')
                        ->paginate(8),
                    "count" => DB::table('notes')->count()
                );
            }
        } else {

            if ($request['search'] && !$request['search-color']) {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(8),
                    "count" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->count()
                );
            } elseif ($request['search-color'] && !$request['search']) {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.color', $request['search-color'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(8),
                    "count" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.color', $request['search-color'])
                        ->count()
                );
            } elseif ($request['search'] && $request['search-color']) {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.color', $request['search-color'])
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->paginate(8),
                    "count" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->where('notes.color', $request['search-color'])
                        ->where(function ($query) use ($request) {
                            $query->orWhere('users.name', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.title', 'LIKE', '%' . $request['search'] . '%')
                                ->orWhere('notes.message', 'LIKE', '%' . $request['search'] . '%');
                        })
                        ->count()
                );
            } else {

                $data = array(
                    "notes" => DB::table('notes')
                        ->join('users', 'notes.user_id', '=', 'users.user_id')
                        ->select('notes.*', 'users.name', 'users.profile')
                        ->orderBy('created_at', 'desc')
                        ->paginate(8),
                    "count" => DB::table('notes')->count()
                );
            }
        }

        return view('notes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => 'required',
            "message" => 'required',
        ]);

        if (!$validator->passes()) {

            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            $values = [
                'user_id' => $request['user_id'],
                'title' => $request['title'],
                'message' => preg_replace("/\r|\n/", "", $request['message']),
                'color' => $request['bg-color'],
            ];

            Notes::create($values);

            session()->flash("message", "New note has been added!");

            return response()->json(['status' => true, 'redirect' => url("/note")]);
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
        $data = DB::table('notes')
            ->join('users', 'notes.user_id', '=', 'users.user_id')
            ->select('notes.title', 'notes.message', 'notes.created_at', 'users.name', 'users.profile')
            ->where('notes.id', $id)
            ->first();

        return response()->json(['result' => $data]);
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
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "edit-title" => 'required',
                "edit-message" => 'required',
            ],
            [
                'edit-title.required' => 'The title field is required.',
                'edit-message.required' => 'The message field is required.',
            ]
        );

        if (!$validator->passes()) {

            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            $values = [
                'title' => $request['edit-title'],
                'message' => preg_replace("/\r|\n/", "", $request['edit-message']),
                'color' => $request['bg-color'],
            ];

            Notes::where('id', $request['edit-id'])->update($values);

            session()->flash("message", "Note has been updated.");

            return response()->json(['status' => true, 'redirect' => url("/note")]);
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
        Notes::where('id', $id)->delete();

        session()->flash("message", "Note has been deleted!");

        return response()->json(['redirect' => url("/note")]);
    }
}
