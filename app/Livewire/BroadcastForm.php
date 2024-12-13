<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\BroadcastFormModel;
use App\Models\ListKontak;
use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Livewire\Livewire;

class BroadcastForm extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $bcname;
    public $kontak;
    public $selectedKontak = [];
    public $scheduleTime;
    public $scheduleDate;
    public $image;
    public $message = '';
    public $buttonUrl = '';
    public $buttonText = '';
    public $showButton = false;
    public $isKontakVisible = false;
    public $broadcastId;
    public $katakunci = '';

    protected $listener = ['broadcastToEdit' => 'setBroadcast'];

    public function mount($id = null)
    {
        if ($id) {
            $broadcast = BroadcastFormModel::findOrFail($id);
            $this->bcname = $broadcast->bcname;
            $this->selectedKontak = $broadcast->kontak;
            $this->scheduleDate = explode(' ', $broadcast->waktu)[0];
            $this->scheduleTime = explode(' ', $broadcast->waktu)[1];
            $this->message = $broadcast->message;
            $this->showButton = $broadcast->showButton;
            $this->buttonText = $broadcast->buttonText;
            $this->buttonUrl = $broadcast->buttonUrl;
            $this->image = $broadcast->image;
        }
    }


    public function render()
    {
        if ($this->katakunci != null) {
            $kontaks = ListKontak::where('nama', 'like', '%' . $this->katakunci . '%')
                ->orderBy('nama', 'desc')
                ->paginate(5);
        } else {
            $kontaks = ListKontak::paginate(5);
        }

        $dataBroadcast = BroadcastFormModel::orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.broadcast-form', compact('dataBroadcast', 'kontaks'));
    }


    public function pilihkontak()
    {
        $this->isKontakVisible = true;
    }

    public function tambahBroadcast()
    {
        if ($this->broadcastId) {

            $broadcast = BroadcastFormModel::find($this->broadcastId);
            $broadcast->update([
                'bcname' => $this->bcname,
                'selected_kontak' => $this->selectedKontak,
                'schedule_time' => $this->scheduleTime,
                'schedule_date' => $this->scheduleDate,
                'image' => $this->image,
                'message' => $this->message,
            ]);
        } else {

            Log::info('Nilai message sebelum validasi: ' . $this->message);
            try {
                Log::info('tambahBroadcast dipanggil');
                Log::info('Nilai input:', [
                    'bcname' => $this->bcname,
                    'selectedKontak' => $this->selectedKontak,
                    'scheduleDate' => $this->scheduleDate,
                    'scheduleTime' => $this->scheduleTime,
                    'message' => $this->message,
                ]);

                // Validate the form inputs
                $this->validate([
                    'bcname' => 'required|string|max:255',
                    'selectedKontak' => 'required|array|min:1',
                    'scheduleDate' => 'required|date',
                    'scheduleTime' => 'required|numeric|min:0|max:23',
                    'message' => 'required|string',
                    'image' => 'nullable|image|max:1024',
                ]);

                $imagePath = null;
                if ($this->image) {
                    $imagePath = $this->image->store('images', 'public');
                    Log::info('Gambar berhasil disimpan di: ' . $imagePath);
                }

                $databc = BroadcastFormModel::create([
                    'bcname' => $this->bcname,
                    'kontak' => count($this->selectedKontak),
                    'waktu' => $this->scheduleDate . ' ' . $this->scheduleTime . ':00:00',
                    'message' => $this->message,
                    'showButton' => intval($this->showButton),
                    'buttonText' => $this->buttonText,
                    'buttonUrl' => $this->buttonUrl,
                    'image' => $imagePath,
                ]);

                Log::info('Data Broadcast berhasil disimpan: ' . json_encode($databc));
                session()->flash('message', 'Data berhasil disimpan.');
                $this->resetInputFields();
            } catch (\Exception $e) {
                Log::error('Error di tambahBroadcast: ' . $e->getMessage());
                session()->flash('error', 'Data gagal disimpan');
            }
        }
    }

    private function resetInputFields()
    {
        $this->bcname = '';
        $this->selectedKontak = [];
        $this->scheduleTime = '';
        $this->scheduleDate = '';
        $this->image = null;
        $this->message = '';
        $this->buttonUrl = '';
        $this->buttonText = "CEK SEKARANG";
        $this->showButton = false;
        $this->isKontakVisible = false;
    }

    public function simpanKontak()
    {
        $this->isKontakVisible = false;
    }


    public function batal()
    {
        $this->isKontakVisible = false;
    }
}
