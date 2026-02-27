<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopItem;
use App\Models\ActivityLog;
use App\Models\Voucher;

class ShopController extends Controller
{
    public function index()
    {
        // Fetch items from DB now
        $items = ShopItem::all();
        return view('shop', compact('items'));
    }

    public function buy(Request $request)
    {
        $user = Auth::user();
        
        // Find item in DB
        $item = ShopItem::where('type', $request->item)->first();

        if (!$item || $user->coins < $item->cost) {
            return back()->with('error', 'Insufficient coins or invalid item.');
        }

        $user->decrement('coins', $item->cost);
        $user->increment($item->column_name, $item->amount);

        // Log the purchase
        ActivityLog::record($user->id, 'Resource Acquired', "Purchased {$item->name}", 'warning');

        return back()->with('success', 'Upgrade purchased successfully!');
    }
    public function redeem(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $user = Auth::user();
        $code = strtoupper($request->code);

        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return back()->with('error', 'Invalid voucher code.');
        }

        if ($voucher->max_uses && $voucher->uses >= $voucher->max_uses) {
            return back()->with('error', 'This voucher has been fully claimed.');
        }

        if ($voucher->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already redeemed this code.');
        }

        // Process Redemption
        $user->increment('coins', $voucher->reward);
        $voucher->increment('uses');
        $voucher->users()->attach($user->id);

        ActivityLog::record($user->id, 'Voucher Redeemed', "Redeemed code {$code} for {$voucher->reward} coins.", 'success');

        return back()->with('success', "Success! {$voucher->reward} coins added to your wallet.");
    }
}