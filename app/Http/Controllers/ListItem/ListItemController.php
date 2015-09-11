<?php

namespace app\Http\Controllers\ListItem;

use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;
use app\ListItem;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response;
use Log;

class ListItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        return view('list.list', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {

            if ($request->input('title') == "") {
                throw new ListItemException('store : title can\'t be null');
            }

            $id = Auth::user()->id;

            $listItem = new ListItem();
            $listItem->title = $request->input('title');
            $listItem->content = $request->input('content');
            $listItem->time = date_create()->format('Y-m-d H:i:s');
            $listItem->belong = $id;
            $listItem->isuse = 1;
            $listItem->save();

            return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);

        } catch (ListItemException $e) {

            return Response()->json(['errno' => 2, 'type' => 'fail', 'msg' => $e->getMessage()]);

        } catch (Exception $e) {

            Log::error($e);
            return Response()->json(['errno' => 1, 'type' => 'fail', 'msg' => 'Whoops, looks like something went wrong']);

        }
    }


    public function show($status)
    {
        try {

            $status = ($status == 'complete') ? 0 : 1;
            $id = Auth::user()->id;

            $listItem = ListItem::where('belong', $id)
                ->where('status', $status)
                ->where('isuse', 1)
                ->orderBy('time', 'desc')
                ->get();

            return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => $listItem]);

        } catch (Exception $e) {

            Log::error($e);
            return Response()->json(['errno' => 1, 'type' => 'fail', 'msg' => 'Whoops, looks like something went wrong']);

        }
    }

    public function detail(Request $request)
    {
        try {

            if ($request->input('id') == "") {
                throw new ListItemException('detail : list id can\'t be null');
            }

            $userid = Auth::user()->id;
            $listid = $request->input('id');

            $listItem = ListItem::where('id', $listid)->where('belong', $userid)->first();

            return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => $listItem]);

        } catch (ListItemException $e) {

            return Response()->json(['errno' => 2, 'type' => 'fail', 'msg' => $e->getMessage()]);

        } catch (Exception $e) {

            Log::error($e);
            return Response()->json(['errno' => 1, 'type' => 'fail', 'msg' => 'Whoops, looks like something went wrong']);

        }
    }

    protected function status(Request $request, $status)
    {
        try {

            if ($request->input('id') == "") {
                throw new ListItemException('status : list id can\'t be null');
            }

            $userid = Auth::user()->id;
            $listid = $request->input('id');

            ListItem::where('id', $listid)->where('belong', $userid)->update(['status' => $status]);

            return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);

        } catch (ListItemException $e) {

            return Response()->json(['errno' => 2, 'type' => 'fail', 'msg' => $e->getMessage()]);

        } catch (Exception $e) {

            Log::error($e);
            return Response()->json(['errno' => 1, 'type' => 'fail', 'msg' => 'Whoops, looks like something went wrong']);

        }
    }

    public function complete(Request $request)
    {
        return $this->status($request, 0);
    }

    public function undo(Request $request)
    {
        return $this->status($request, 1);
    }

    public function update(Request $request)
    {
        try {

            if ($request->input('id') == "" || $request->input('title') == "") {
                Log::info('apple watch');
                throw new ListItemException('update : list id and title can\'t be null');
            }

            $userid = Auth::user()->id;
            $listid = $request->input('id');

            $listItem = ListItem::where('id', $listid)->where('belong', $userid)->first();
            $listItem->title = $request->input('title');
            $listItem->content = $request->input('content');
            $listItem->time = date_create()->format('Y-m-d H:i:s');

            $listItem->save();

            return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);

        } catch (ListItemException $e) {

            return Response()->json(['errno' => 2, 'type' => 'fail', 'msg' => $e->getMessage()]);

        } catch (Exception $e) {

            Log::error($e);
            return Response()->json(['errno' => 1, 'type' => 'fail', 'msg' => 'Whoops, looks like something went wrong']);

        }
    }


    public function destroy(Request $request)
    {
        try {

            if ($request->input('id') == "") {
                throw new ListItemException('destroy : list id can\'t be null');
            }

            $userid = Auth::user()->id;
            $listid = $request->input('id');

            $listItem = ListItem::where('id', $listid)->where('belong', $userid)->first();
            $listItem->isuse = 0;

            $listItem->save();

            return Response()->json(['errno' => 0, 'type' => 'succ', 'msg' => (object)array()]);

        } catch (ListItemException $e) {

            return Response()->json(['errno' => 2, 'type' => 'fail', 'msg' => $e->getMessage()]);

        } catch (Exception $e) {

            Log::error($e);
            return Response()->json(['errno' => 1, 'type' => 'fail', 'msg' => 'Whoops, looks like something went wrong']);

        }
    }
}

class ListItemException extends Exception
{

}
