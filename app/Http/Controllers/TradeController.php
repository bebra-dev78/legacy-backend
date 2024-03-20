<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade;
use Carbon\Carbon;

class TradeController extends Controller
{
    public function overview(Request $request)
    {
        $uid = $request->header('X-ABOBA-UID');

        if (!$uid) {
            abort(401);
        }

        $currentTime = Carbon::now()->timestamp * 1000;

        return response()->json(Trade::where('uid', $uid)
            ->where('entry_time', '>=', $currentTime - 604800000)
            ->where('entry_time', '<=', $currentTime)
            ->get()
            ->toArray());
    }

    public function table(Request $request)
    {
        $uid = $request->header('X-ABOBA-UID');

        if (!$uid) {
            abort(401);
        }

        return response()->json(Trade::where('uid', $uid)
            ->orderBy('entry_time', 'desc')
            ->paginate($request->input("pageSize")));
    }

    public function analytics(Request $request)
    {
        $uid = $request->header('X-ABOBA-UID');

        if (!$uid) {
            abort(401);
        }

        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');

        return response()->json(Trade::where('uid', $uid)
            ->where('entry_time', '>=', $startTime)
            ->where('entry_time', '<=', $endTime)
            ->get()
            ->toArray());
    }

    public function journal(Request $request)
    {
        $uid = $request->header('X-ABOBA-UID');

        if (!$uid) {
            abort(401);
        }

        return response()->json([]);
    }
}
