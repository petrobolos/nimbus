<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page for authenticated users.
     *
     * @return \Inertia\Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard');
    }
}
