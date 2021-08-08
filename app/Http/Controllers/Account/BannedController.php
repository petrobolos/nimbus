<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class BannedController
 *
 * @package App\Http\Controllers
 */
class BannedController extends Controller
{
    /**
     * Display the banned page.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('pages.account.banned');
    }
}
