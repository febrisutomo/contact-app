<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ContactCreate extends Component
{
    use WithFileUploads;
    public $name;
    public $phone;
    public $image;

    public function render()
    {
        return view('livewire.contact-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required',
            // 'image' => 'image|max:1024'
        ]);

        if($this->image){
            $fileName = time().'.'.$this->image->extension();
            $this->image->storeAs('profile', $fileName);
        }
        else{
            $fileName = 'default-profile.png';
        }

        $contact = Contact::create([
            'name' => $this->name,
            'phone' => Str::remove(' ', $this->phone),
            'image' => $fileName
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        $this->emit('flashMessage', 'Contact '.$contact->name.' was created');

    }

    public function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->image = null;
    }
}
