<?php
namespace App\Http\Controllers;

use App\Entities\Member;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $g_member = Member::query()->find(Auth::id());
        // Sharing is caring
        View::share('g_member', $g_member);
    }
}