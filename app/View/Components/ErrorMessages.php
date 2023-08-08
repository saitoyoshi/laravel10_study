<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class ErrorMessages extends Component
{
    /**
     * Create a new component instance.
     */
    public ViewErrorBag $errors;
    public function __construct($errors)
    {
        $this->errors = $errors;
    }
    /**
     * エラーが２件以上あるかどうか
     */
    public function has2MoreErrors() {
        return count($this->errors) > 2;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-messages');
    }
}
