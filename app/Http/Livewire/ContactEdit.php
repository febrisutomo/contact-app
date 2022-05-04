<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;


class ContactEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $phone;
    public $image;
    public $imageNew;
    public $contactId;

    protected $listeners = [
        'showContact'
    ];

    public function render()
    {
        return view('livewire.contact-edit');
    }

    public function showContact($contact)
    {
        $this->name = $contact['name'];
        $this->phone = $contact['phone'];
        $this->image = $contact['image'];
        $this->contactId = $contact['id'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required',
            // 'imageNew' => 'image|max:1024'
        ]);
        
        if($this->imageNew){
            $fileName = time().'.'.$this->imageNew->extension();
            $this->imageNew->storeAs('profile', $fileName);

            if(File::exists('storage/profile/'.$this->image) && $this->image!='default-profile.png'){
                File::delete('storage/profile/'.$this->image);
            }
        }
        else{
            $fileName = $this->image;
        }

        if($this->contactId){
            $contact = Contact::find($this->contactId);
            $contact->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'image' => $fileName
            ]);
            $this->imageNew = null;
            $this->dispatchBrowserEvent('closeModal');
            $this->emit('flashMessage', 'Contact '.$contact->name.' was updated');
        }
    }

    public function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->image = null;
        $this->imageNew = null;
    }
}
