<?php


namespace App\Helpers;

use App\Models\AdminUserType;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteHelper
{
    public static function adminCan($perm, $guard = 'admin')
    {
        $user = Auth::guard($guard)->user()->load('adminUserType');

        $type = $user->adminUserType;

        $permissions = $type->urlPermissions()->wherePivot('is_active', true)->pluck('slug')->toArray();

        return in_array($perm, $permissions);
    }

    public static function adminCanAll($perm, $guard = 'admin')
    {
        $permissionsGiven = is_array($perm) ? $perm : array_unique(explode("|", $perm));

        $permissionStatus = true;

        $user = Auth::guard($guard)->user()->load('adminUserType');

        $type = $user->adminUserType;

        $permissions = $type->urlPermissions()->wherePivot('is_active', true)->pluck('slug')->toArray();

        // $permissions = Cache::remember('adminUrlPermissions', 60, function () use ($type) {
        //     return $type->urlPermissions()->wherePivot('is_active', true)->pluck('slug')->toArray();
        // });

        foreach ($permissionsGiven as $permission) {

            if (!in_array($permission, $permissions)) {
                $permissionStatus = false;
                break;
            }
        }

        return $permissionStatus;
    }

    public function getFormattedDate($date)
    {
        // return Carbon::parse($date)->format('d-m-Y');
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public function getReformattedDate($date)
    {
        // return Carbon::parse($date)->format('d-m-Y');
        return date('d F, Y', strtotime($date));
    }
}
