<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class AppLayout
 *
 * @package App\View\Components
 */
class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
