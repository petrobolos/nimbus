<?php

namespace App\Http\Controllers;

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
