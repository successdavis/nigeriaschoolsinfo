<?php

namespace App\Http\Livewire;

use App\Post;
use Livewire\Component;

class PostsPage extends Component
{
	public $search = '';
	public $count = 0;

    public function render()
    {
        return view('livewire.posts-page', [
        	'posts' => Post::where(
        		'title', 'LIKE', '%' . $this->search . '%'
        	)->orWhere(
        		'body', 'LIKE', '%' . $this->search . '%'
        	)->latest()->get()
        ]);
    }

    public function increment()
    {
        $this->count++;
    }
}
