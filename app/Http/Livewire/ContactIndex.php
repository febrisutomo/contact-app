<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pageLength = 5;
    
    public $search = '';
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = [
        'flashMessage',
    ];

    public function render()
    {
        $contacts = Contact::orderBy('name')->where('name', 'like', '%' . $this->search . '%')->orWhere('phone', 'like', '%' . $this->search . '%')->paginate($this->pageLength);
        return view('livewire.contact-index', compact('contacts'));
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        $this->emit('showContact', $contact);
    }

    public function destroy($id)
    {
        if($id){
            Contact::find($id)->delete();
            $this->flashMessage('Contact was deleted!');
        }
    }

    public function flashMessage($message)
    {
        session()->flash('message', $message);
        $this->statusEdit = false;
    }


}
