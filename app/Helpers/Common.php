<?php

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

function admin_asset($path)
{
    // remove leading slash
    $path = ltrim($path, '/');
    return asset('admin/' . $path);
}

function baseUrl()
{
    return asset('');
}
if (!function_exists('dummy_image')) {
    /**
     * Returns full path to dummy profile picture
     *
     * @return string
     */
    function dummy_image(): string
    {
        return asset('images/users/dummy.png');
    }
}

function getLoggerTypeClassBaseNameInUpperString($class)
{
    return strtoupper(class_basename($class));
}


function mix_asset($path)
{
    $path = ltrim($path, '/');
    return asset('/' . $path);
}
if (!function_exists('gull_asset')) {
    /**
     * Returns full path to gull assets
     *
     * @param string $path The path to the file.
     * @return string
     */
    function gull_asset($path): string
    {
        return asset('gull/assets/' . $path);
    }
}

function js_asset($path)
{
    $path = ltrim($path, '/');
    return mix_asset('js/' . $path);
}

function baseAdminUrl()
{
    return url('admin');
}

function page_js($path)
{
    $path = ltrim($path, '/');
    return js_asset('/' . $path);
}

function storage_url($filepath = '')
{
    $defaultDisk = config('filesystems.default');
    $path = config('filesystems.disks.' . $defaultDisk . '.url');
    $path = rtrim($path, '/') . '/';
    $filepath = ltrim($filepath, '/');
    $url = $path . $filepath;
    return $url;
}

function component_js($path)
{
    $path = ltrim($path, '/');
    return js_asset('components/' . $path);
}

if (!function_exists('generateRandomString')) {
    /**
     * Generate a random string of the specified length
     *
     * @return string|null
     */
    function generateRandomString(int $length = 8)
    {
        return \Str::random($length);
    }
}

if (!function_exists('getServiceTypes')) {
    /**
     * Generate a random string of the specified length
     *
     * @return string|null
     */
    function getServiceTypes()
    {
        $serviceTypes = ServiceType::where('status', 1)->get();
        return $serviceTypes;
    }
}

function convertRequest($request)
{
    if ($request instanceof Request) {
        $request = $request->all();
    }

    return $request;
}
