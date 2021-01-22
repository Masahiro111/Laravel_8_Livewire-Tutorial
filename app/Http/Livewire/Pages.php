<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class Pages extends Component
{
    public $modalFormVisible = false;
    public $slug;
    public $title;
    public $content;

    public function create()
    {
        Page::create($this->modelData());
        $this->modalFormVisible = false;
    }

    public function createShowModal()
    {
        $this->modalFormVisible = true;
    }

    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }

    public function render()
    {
        return view('livewire.pages');
    }
}
