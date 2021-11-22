<?php

namespace App\View\Components\Frontend\Sidebar;

use Illuminate\View\Component;

class SpecialOffer extends Component
{
    /**
     * set property
     */
    public $products;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $title)
    {
        $this->products = $products;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.sidebar.special-offer');
    }
}
