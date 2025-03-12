<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Summernote extends Component
{
    public $id;
    public $name;
    public $value;
    public function __construct($id, $name, $value = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('admin.posts.components.summernote-plugin', [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value
        ]);
    }
}