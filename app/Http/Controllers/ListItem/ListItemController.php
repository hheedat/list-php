<?php

namespace App\Http\Controllers\ListItem;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ListItem;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

//use DB;

class ListItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $listItem = DB::select('select * from think_list');
        $id = Auth::user()->id;

//        $listItem = ListItem::where('belong', $id)->get();

        return view('list.list', [
            'user' => Auth::user(),
//            'listItem' => $listItem
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;

        $listItem = new ListItem();
        $listItem->title = $request->input('title');
        $listItem->content = $request->input('content');
        $listItem->time = date_create()->format('Y-m-d H:i:s');
        $listItem->belong = $id;
        $listItem->isuse = 1;
        $listItem->save();

        return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);
    }


    public function show($status)
    {
        $status = ($status == 'complete') ? 0 : 1;
        $id = Auth::user()->id;

        $listItem = ListItem::where('belong', $id)
            ->where('status', $status)
            ->where('isuse', 1)
            ->orderBy('time', 'desc')
            ->get();

        return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => $listItem]);
    }

    public function detail(Request $request)
    {
        $userid = Auth::user()->id;
        $listid = $request->input('id');

        $listItem = ListItem::where('id', $listid)->where('belong', $userid)->first();

        return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => $listItem]);
    }

    protected function status(Request $request, $status)
    {
        $userid = Auth::user()->id;
        $listid = $request->input('id');

        ListItem::where('id', $listid)->where('belong', $userid)->update(['status' => $status]);

        return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);
    }

    public function complete(Request $request)
    {
        return $this->status($request, 0);
    }

    public function undo(Request $request)
    {
        return $this->status($request, 1);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $userid = Auth::user()->id;
        $listid = $request->input('id');

        $listItem = ListItem::where('id', $listid)->where('belong', $userid)->first();
        $listItem->title = $request->input('title');
        $listItem->content = $request->input('content');
        $listItem->time = date_create()->format('Y-m-d H:i:s');

        $listItem->save();

        return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);
    }


    public function destroy(Request $request)
    {
        $userid = Auth::user()->id;
        $listid = $request->input('id');

        $listItem = ListItem::where('id', $listid)->where('belong', $userid)->first();
        $listItem->isuse = 0;

        $listItem->save();

        return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);
    }
}
