<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\prodashpost;
use Livewire\WithPagination;

class ProjectDash extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'simple-tailwind';

    public $showModal = false;
    public $confirmDelete = false;
    public $nama_project;
    public $nomer_hp;
    public $username;
    public $facebook;
    public $password;
    public $image;
    public $imageUrl;
    public $deleteId;
    public $recentProject;

    public function mount()
    {
        $this->recentProject = prodashpost::latest()->get();
    }

    public function render()
    {
        $latestProject = prodashpost::latest()->paginate(5);

        return view('livewire.project-dash', [
            'latestProject' => $latestProject,
            'recentProject' => $this->recentProject,
        ]);
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->image = null;
        $this->imageUrl = null;
    }

    public function createProject()
    {
        $validatedData = $this->validate([
            'nama_project' => 'required|string|max:255',
            'nomer_hp' => 'required|string|max:15',
            'username' => 'required|string|max:50',
            'facebook' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($this->image) {
            $imagepath = $this->image->store('images', 'public');
        } else {
            $imagepath = null;
        }

        prodashpost::create([
            'nama_project' => $this->nama_project,
            'no_handphone' => $this->nomer_hp,
            'username' => $this->username,
            'facebook' => $this->facebook,
            'password' => ($this->password),
            'image' => $imagepath,
        ]);

        $this->closeModal();
        session()->flash('message', 'Project created successfully!');
    }

    public function updatedImage()
    {
        $this->imageUrl = $this->image->temporaryUrl();
    }

    public function confirmDelete() {}

    public function delete() {}
}
