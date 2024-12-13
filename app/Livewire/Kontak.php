<?php

namespace App\Livewire;

use App\Models\ListKontak;
use Livewire\Component;
use Livewire\WithPagination;

class Kontak extends Component
{
    use WithPagination;

    protected $paginationTheme = 'simple-tailwind';
    public $isVisible = false;
    public $nama;
    public $no_hp;
    public $email;
    public $facebook;
    public $updatedata = false;
    public $deletedata = false;
    public $kontak_id;
    public $deleteKontakId;
    public $isModalOpen = false;
    public $gajadi;
    public $katakunci;



    public function tambahkontak()
    {
        $this->isVisible = true;
        $rules = [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|string|max:255',
        ];

        $this->validate($rules);

        ListKontak::create([
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'facebook' => $this->facebook,
        ]);

        $this->reset(['nama', 'no_hp', 'email', 'facebook']);
        $this->isVisible = false;
    }

    public function edit($id)
    {
        $this->isVisible = true;
        $data = ListKontak::find($id);
        $this->nama = $data->nama;
        $this->no_hp = $data->no_hp;
        $this->email = $data->email;
        $this->facebook = $data->facebook;
        $this->updatedata = true;
        $this->kontak_id = $id;
    }

    public function update()
    {
        $this->isVisible = true;
        $rules = [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|string|max:255',
        ];

        $validated = $this->validate($rules);
        $data = ListKontak::find($this->kontak_id);
        $data->update($validated);
        // $this->reset(['nama', 'no_hp', 'email', 'facebook', 'kontak_id']);
        $this->isVisible = false;
    }


    public function delete()
    {
        $id = $this->kontak_id;  // Get the ID from the class property
        $this->isModalOpen = true;
        $kontak = ListKontak::find($id);

        if ($kontak) {
            $kontak->delete();
        } else {
            $this->addError('kontak_id', 'Contact not found.');
        }
    }


    public function delete_confirmation($id)
    {
        $this->isModalOpen = true;
        $this->kontak_id = $id;
    }

    public function batal()
    {
        $this->isModalOpen = false;
        $this->isVisible = false;
    }


    public function render()
    {
        if ($this->katakunci != null) {
            $data = ListKontak::where('nama', 'like', '%' . $this->katakunci . '%')
                ->orderBy('nama', 'asc')
                ->paginate(5);
        } else {
            $data = ListKontak::paginate(5);
        }

        return view('livewire.kontak', ['dataKontak' => $data]);
    }
}
