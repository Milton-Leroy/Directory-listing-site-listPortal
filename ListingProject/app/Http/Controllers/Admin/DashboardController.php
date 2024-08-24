<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Claim;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(): view
    {
        $totalListingCount = Listing::count();
        $pendingListingCount = Listing::where('is_approved', 0)->count();
        $activeListingCount = Listing::where('is_approved', 1)->count();
        $orderCount = Order::count();
        $claimCount = Claim::count();
        $listingCategoryCount = Category::count();
        $locationCount = Location::count();
        $blogCount = Blog::count();
        $blogCategoryCount = BlogCategory::count();
        $adminCount = User::where('user_type', 'admin')->count();
        $userCount = User::where('user_type', 'user')->count();
        $permissionCount = Permission::count();
        $roleCount = Role::count();
        return view(
            'admin.dashboard.index',
            compact(
                'totalListingCount',
                'pendingListingCount',
                'activeListingCount',
                'orderCount',
                'claimCount',
                'listingCategoryCount',
                'locationCount',
                'blogCount',
                'blogCategoryCount',
                'adminCount',
                'userCount',
                'permissionCount',
                'roleCount'
            )
        );
    }
}
