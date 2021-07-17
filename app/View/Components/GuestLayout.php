<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class GuestLayout
 *
 * @package App\View\Components
 */
class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
