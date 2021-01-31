<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NavigationMenu;
use Livewire\WithPagination;

class NavigationMenus extends Component
{

    use WithPagination;

    public $modalFormVisible;

    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'SidebarNav';


    public function rules()
    {
        return [
            'label' => 'required',
            'slug' => 'required',
            'sequence' => 'required',
            'type' => 'required',
        ];
    }

    public function create()
    {
        $this->validate();
        NavigationMenu::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function modelData()
    {
        return [
            'label' => $this->label,
            'slug' => $this->slug,
            'sequence' => $this->sequence,
            'type' => $this->type
        ];
    }

    public function read()
    {
        return NavigationMenu::paginate(5);
    }


    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    public function loadModel()
    {
        $data = NavigationMenu::find($this->modelId);
        $this->label = $data->label;
        $this->slug = $data->slug;
        $this->type = $data->type;
        $this->sequence = $data->sequence;
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read(),
        ]);
    }
}
