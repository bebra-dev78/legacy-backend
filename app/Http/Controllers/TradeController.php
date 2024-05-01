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

        $trades = Trade::where('uid', $uid)
            ->where('entry_time', '>=', $currentTime - 864000000)
            ->where('entry_time', '<=', $currentTime)
            ->get()
            ->toArray();

        return response()->json($trades);
    }

    public function table(Request $request)
    {
        $uid = $request->header('X-ABOBA-UID');

        if (!$uid) {
            abort(401);
        }

        return response()->json(Trade::where('uid', $uid)
            ->paginate($request->input("pageSize")));
    }

    public function time(Request $request)
    {
        $uid = $request->header('X-ABOBA-UID');

        if (!$uid) {
            abort(401);
        }

        return response()->json(Trade::where('uid', $uid)
            ->where('entry_time', '>=', $request->input('startTime'))
            ->where('entry_time', '<=', $request->input('endTime'))
            ->orderBy('entry_time', 'asc')
            ->get()
            ->toArray());
    }
}
