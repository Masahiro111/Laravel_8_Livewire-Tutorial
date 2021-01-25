<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class Pages extends Component
{

    use WithPagination;

    public $modalConfirmDeleteVisible = false;
    public $modalFormVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;



    public function read()
    {
        return Page::paginate(5);
    }


    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')
                ->ignore($this->modelId)],
            'content' => 'required'
        ];
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->resetPage();
    }

    public function updatedTitle($value)
    {
        $this->generateSlug($value);
    }

    private function generateSlug($value)
    {
        $process1 = str_replace(' ', '-', $value);
        $process2 = strtolower($process1);
        $this->slug = $process2;
    }

    public function create()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function update()
    {
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }


    public function delete()
    {
        // dd("delete");
        Page::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    public function deleteShowModal($id)
    {
        $this->modalId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }

    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaultNotFoundPage,
        ];
    }

    public function resetVars()
    {
        $this->modelId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }

    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }
}
