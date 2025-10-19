<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StrawberryProduct;

class AdminController extends Controller
{
    // Middleware is handled in routes/web.php

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalProducts = StrawberryProduct::count();
        $totalStock = StrawberryProduct::sum('stock_quantity');
        
        $recentUsers = User::latest()->take(5)->get();
        $lowStockProducts = StrawberryProduct::where('stock_quantity', '<', 10)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins', 
            'totalProducts',
            'totalStock',
            'recentUsers',
            'lowStockProducts'
        ));
    }

    /**
     * Show users management
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role user berhasil diperbarui!');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}
