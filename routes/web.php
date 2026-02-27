<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\{User, Server, ActivityLog, Announcement};
use App\Http\Controllers\{ShopController, DeploymentController, AdminController, ServerManagerController, TicketController, RewardController};

// Public Landing Page
Route::get('/', function () { return view('welcome'); });

// Standard Laravel Auth
Auth::routes();

// All Protected Dashboard Routes
Route::middleware('auth')->group(function () {
    
    // --- 1. MAIN DASHBOARD (FIXED) ---
Route::get('/dashboard', function (\App\Services\PterodactylService $ptero) {
    $user = Auth::user(); 
    $servers = $user->servers; // Get user's servers
    
    // 1. Fetch REAL Nodes from Pterodactyl
    $nodeResponse = $ptero->getNodes();
    $nodes = $nodeResponse->successful() ? collect($nodeResponse->json('data'))->take(3) : collect([]);

    // 2. Fetch Logs & Announcements
    $recentLogs = \App\Models\ActivityLog::where('user_id', $user->id)->latest()->take(5)->get();
    $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();    

    // 3. Generate Chart Data
    $chartLabels = []; $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $chartLabels[] = \Carbon\Carbon::now()->subDays($i)->format('D');
        $usage = $user->usedRam();
        $chartData[] = $usage > 0 ? rand($usage * 0.8, $usage) : 0;
    }

    return view('dashboard', compact('servers', 'user', 'recentLogs', 'announcements', 'chartLabels', 'chartData', 'nodes'));
})->name('dashboard');

    // --- 2. SERVER MANAGEMENT ---
    Route::prefix('/server/{server}')->name('servers.')->group(function () {
        Route::get('/manage', [ServerManagerController::class, 'console'])->name('manage');
        Route::get('/files', [ServerManagerController::class, 'files'])->name('files');
        Route::get('/files/edit', [ServerManagerController::class, 'editFile'])->name('files.edit');
        Route::post('/files/save', [ServerManagerController::class, 'saveFile'])->name('files.save');
        Route::get('/databases', [ServerManagerController::class, 'databases'])->name('databases');
        Route::post('/databases', [ServerManagerController::class, 'storeDatabase'])->name('databases.create');
        Route::get('/schedules', [ServerManagerController::class, 'schedules'])->name('schedules');
        Route::get('/network', [ServerManagerController::class, 'network'])->name('network');
        Route::get('/users', [ServerManagerController::class, 'users'])->name('users');
        Route::get('/backups', [ServerManagerController::class, 'backups'])->name('backups');
        Route::post('/backups', [ServerManagerController::class, 'storeBackup'])->name('backups.create');
        Route::get('/startup', [ServerManagerController::class, 'startup'])->name('startup');
        Route::get('/settings', [ServerManagerController::class, 'settings'])->name('settings');
    });

    // --- 3. COMMERCE & ECONOMY ---
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::post('/shop/buy', [ShopController::class, 'buy'])->name('shop.buy');
    Route::post('/shop/redeem', [ShopController::class, 'redeem'])->name('shop.redeem');
    Route::get('/billing', function () {
        $transactions = ActivityLog::where('user_id', Auth::id())->whereIn('action', ['Resource Acquired', 'Coins Added', 'Voucher Redeemed'])->latest()->paginate(10);
        return view('billing', compact('transactions'));
    })->name('billing');
    Route::get('/billing/add-funds', function() { return view('add-funds'); })->name('billing.add');

    // --- 4. REWARDS, REFS & LEADERBOARD ---
    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards');
    Route::post('/rewards/claim', [RewardController::class, 'claimDaily'])->name('rewards.claim');
    Route::get('/referrals', function () {
        $user = Auth::user();
        $referredUsers = $user->referrals()->latest()->get();
        return view('referrals', compact('user', 'referredUsers'));
    })->name('referrals');
    Route::get('/leaderboard', function () {
        $topUsers = User::orderBy('coins', 'desc')->take(10)->get();
        return view('leaderboard', compact('topUsers'));
    })->name('leaderboard');

    // --- 5. DEPLOYMENT ---
    Route::get('/deploy', [DeploymentController::class, 'create'])->name('servers.create');
    Route::post('/deploy', [DeploymentController::class, 'store'])->name('servers.store');
    Route::delete('/deploy/{server}', [DeploymentController::class, 'destroy'])->name('servers.destroy');

    // --- 6. SUPPORT ---
    Route::get('/help', function() { return view('support'); })->name('support.hub');
    Route::get('/support', [TicketController::class, 'index'])->name('support');
    Route::get('/support/new', [TicketController::class, 'create'])->name('support.create');
    Route::post('/support/new', [TicketController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket}', [TicketController::class, 'show'])->name('support.show');
    Route::post('/support/{ticket}', [TicketController::class, 'reply'])->name('support.reply');

    // --- 7. DEVELOPERS & ACTIVITY ---
    Route::get('/account/api', function () { return view('account.api'); })->name('account.api');
    Route::get('/account/activity', function () {
        $logs = ActivityLog::where('user_id', Auth::id())->latest()->paginate(15);
        return view('account.activity', compact('logs'));
    })->name('account.activity');

    Route::get('/account', function () { return view('account'); })->name('account');

    // --- 8. ADMIN PANEL ---
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::get('/servers', [AdminController::class, 'servers'])->name('servers');
        Route::delete('/servers/{server}', [AdminController::class, 'deleteServer'])->name('servers.delete');
        Route::get('/store', [AdminController::class, 'store'])->name('store');
        Route::post('/store', [AdminController::class, 'updateStore'])->name('store.update');
        Route::get('/activity', [AdminController::class, 'activity'])->name('activity');
        Route::get('/announcements', [AdminController::class, 'announcements'])->name('announcements');
        Route::post('/announcements', [AdminController::class, 'createAnnouncement'])->name('announcements.create');
        Route::delete('/announcements/{announcement}', [AdminController::class, 'deleteAnnouncement'])->name('announcements.delete');
        Route::get('/vouchers', [AdminController::class, 'vouchers'])->name('vouchers');
        Route::post('/vouchers', [AdminController::class, 'createVoucher'])->name('vouchers.create');
        Route::delete('/vouchers/{voucher}', [AdminController::class, 'deleteVoucher'])->name('vouchers.delete');
        Route::get('/nodes', [AdminController::class, 'nodes'])->name('nodes');
        Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
        Route::get('/tickets/{ticket}', [AdminController::class, 'showTicket'])->name('tickets.show');
        Route::post('/tickets/{ticket}/reply', [AdminController::class, 'replyTicket'])->name('tickets.reply');
        Route::post('/tickets/{ticket}/close', [AdminController::class, 'closeTicket'])->name('tickets.close');
        Route::get('/users/{user}/impersonate', [AdminController::class, 'impersonate'])->name('users.impersonate');
        Route::get('/stop-impersonation', [AdminController::class, 'stopImpersonate'])->name('users.stop-impersonation');
    });
});