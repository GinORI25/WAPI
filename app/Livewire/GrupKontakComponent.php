<?php

namespace App\Livewire;

use App\Models\GrupKontak;
use App\Models\ListKontak;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Contracts\Service\Attribute\Required;

class GrupKontakComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'simple-tailwind';
    public $nama_grup;
    public $selected_kontak = [];
    public $grup_id;
    public $updatedatagrup = false;
    public $isGrupVisible = false;
    public $isModalGrupOpen = false;
    public $katakunci = '';



    public function tambahgrup()
    {

        $this->isGrupVisible = true;
        $validatedData = $this->validate([
            'nama_grup' => 'required',
            'selected_kontak' => 'required|array|min:1',
        ]);

        $grup = GrupKontak::create([
            'nama_grup' => $this->nama_grup,
            'jumlah_kontak' =>  count($this->selected_kontak),
        ]);

        $grup->kontak()->attach($this->selected_kontak);

        $this->refreshgrup();

        $this->isGrupVisible = false;
    }

    private function refreshgrup()
    {
        $this->nama_grup = '';
        $this->selected_kontak = [];
        $this->isGrupVisible = false;
    }

    public function editgrup($id)
    {
        $this->isGrupVisible = true;
        $grup = GrupKontak::find($id);
        $this->grup_id = $grup->id;
        $this->nama_grup = $grup->nama_grup;
        $this->selected_kontak = $grup->kontak->pluck('id')->toArray();
        $this->updatedatagrup = true;
    }


    public function updategrup()
    {
        $this->validate([
            'nama_grup' => 'required|string|max:255',
            'selected_kontak' => 'required|array|min:1',
        ]);

        $grup = GrupKontak::find($this->grup_id);

        if ($grup) {
            $grup->update([
                'nama_grup' => $this->nama_grup,
                'jumlah_kontak' => count($this->selected_kontak),
            ]);

            $grup->kontak()->sync($this->selected_kontak);

            $this->isGrupVisible = false;
        }
    }


    public function confirmdelete($id)
    {
        $this->grup_id = $id;
        $this->isModalGrupOpen = true;
    }

    public function delete()
    {
        $id = $this->grup_id;
        $grup = GrupKontak::find($id);

        if ($grup) {
            $grup->delete();
        } else {
            $this->addError('grup_id', 'Grup Not Found');
        }

        $this->isModalGrupOpen = false;
    }

    public function gajadi()
    {
        $this->isModalGrupOpen = false;
    }

    public function batal()
    {
        $this->isGrupVisible = false;
    }

    public function render()
    {
        if ($this->katakunci != null) {
            $dataGrup = GrupKontak::where('nama_grup', 'like', '%' . $this->katakunci . '%')
                ->orderBy('nama_grup', 'asc')
                ->paginate(5);
        } else {
            $dataGrup = GrupKontak::orderBy('created_at', 'asc')->paginate(5);
        }

        $kontaks = ListKontak::paginate(5);
        return view('livewire.grup-kontak-component', compact('dataGrup', 'kontaks'));
    }
}
