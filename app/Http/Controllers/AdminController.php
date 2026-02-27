<?php

namespace App\Http\Controllers;

use App\Models\{User, Server, ActivityLog, Announcement, ShopItem, Voucher, Ticket, TicketMessage};
use Illuminate\Http\Request;
use App\Services\{PterodactylService, WingsApiService};
use Illuminate\Support\Facades\{DB, Auth, Session}; // <--- FIXED: Added Auth and Session here
use Carbon\Carbon;

class AdminController extends Controller
{
    // Admin Dashboard Overview
    public function index(PterodactylService $ptero)
    {
        $stats = [
            'total_users' => User::count(),
            'total_servers' => Server::count(),
            'total_coins' => User::sum('coins'),
            'total_ram' => Server::sum('memory'),
        ];

        $chartData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')->orderBy('date', 'ASC')->get();

        $labels = []; $dataPoints = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->format('M d');
            $record = $chartData->firstWhere('date', $date);
            $dataPoints[] = $record ? $record->count : 0;
        }

        $logs = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.index', compact('stats', 'labels', 'dataPoints', 'logs'));
    }

    // --- USER MANAGEMENT ---
    public function users() {
        $users = User::withCount('servers')->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function updateUser(Request $request, User $user) {
        $request->validate([
            'coins' => 'required|integer',
            'max_servers' => 'required|integer',
            'max_ram' => 'required|integer',
        ]);
        $user->update($request->all());
        $user->update(['has_panel_access' => $request->has('has_panel_access')]);
        return back()->with('success', "Commander {$user->name} updated.");
    }

    // NEW FEATURE: IMPERSONATION (Login as User)
    public function impersonate(User $user) {
        if (!Auth::user()->is_admin) abort(403);
        
        // Save Admin ID in session so we can go back
        Session::put('impersonate', Auth::id());
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', "Impersonating {$user->name}");
    }

    public function stopImpersonate() {
        $adminId = Session::pull('impersonate');
        if ($adminId) {
            $admin = User::find($adminId);
            Auth::login($admin);
            return redirect()->route('admin.users')->with('success', "Returned to Admin Control.");
        }
        return redirect('/');
    }

    // --- SERVER MANAGEMENT ---
    public function servers() {
        $servers = Server::with('user')->paginate(15);
        return view('admin.servers', compact('servers'));
    }

    public function deleteServer(Server $server) {
        $server->delete();
        return back()->with('success', 'Server removed from local records.');
    }

    // --- STORE ---
    public function store() {
        return view('admin.store', ['items' => ShopItem::all()]);
    }

    public function updateStore(Request $request) {
        foreach($request->items as $id => $data) {
            ShopItem::where('id', $id)->update(['cost' => $data['cost'], 'amount' => $data['amount']]);
        }
        return back()->with('success', 'Pricing updated.');
    }

    // --- LOGS & BROADCASTS ---
    public function activity() {
        return view('admin.activity', ['logs' => ActivityLog::with('user')->latest()->paginate(25)]);
    }

    public function announcements() {
        return view('admin.announcements', ['announcements' => Announcement::latest()->get()]);
    }

    public function createAnnouncement(Request $request) {
        Announcement::create($request->all());
        return back()->with('success', 'Broadcast sent.');
    }

    // --- TICKET SYSTEM (FIXED) ---
    public function tickets() {
        $tickets = Ticket::with('user')->latest()->paginate(15);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function showTicket(Ticket $ticket) {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function replyTicket(Request $request, Ticket $ticket) {
        $request->validate(['message' => 'required']);
        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(), // <--- THIS WILL WORK NOW
            'message' => $request->message
        ]);
        $ticket->update(['status' => 'answered']);
        return back()->with('success', 'Reply transmitted.');
    }

    public function closeTicket(Ticket $ticket) {
        $ticket->update(['status' => 'closed']);
        return back()->with('success', 'Ticket finalized.');
    }

    public function vouchers() {
        return view('admin.vouchers', ['vouchers' => Voucher::latest()->get()]);
    }

    public function createVoucher(Request $request) {
        Voucher::create($request->all());
        return back()->with('success', 'Voucher active.');
    }

    public function nodes(PterodactylService $ptero) {
        $response = $ptero->getNodes();
        $nodes = $response->successful() ? $response->json('data') : [];
        return view('admin.nodes', compact('nodes'));
    }
}