<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class FaqController
 *
 * @package App\Http\Controllers
 */
class FaqController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('pages.faqs');
    }
}
