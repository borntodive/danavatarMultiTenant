<?php

namespace App\Http\Livewire\Weareble;

use App\Models\Comment;
use App\Models\Sensor;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $date;

    public $time;

    public $comments;

    public $sensor;

    public User $user;

    public $showDeleteModal = false;

    public ?Comment $commentToBeDeleted;

    public $showEditModal = false;

    public Comment $commentToBeEdited;

    public $loadedTime = null;

    public $commentText;

    public $editingEditModal = true;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function mount()
    {
        $this->comments = $this->getComments();
    }

    private function getComments()
    {
        $sensor = Sensor::findOrFail($this->sensor);
        $dateArray = explode('-', $this->date);
        $searchData = Carbon::create($dateArray[0], $dateArray[1], $dateArray[2], 0);
        $startTimeString = "timestamp '".$searchData->toDateTimeString()."'";
        $endTimeString = "timestamp '".$searchData->addDay()->toDateTimeString()."'";

        return Comment::whereRaw('time >= '.$startTimeString.' AND time < '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$this->user->id)->orderBy('time')->get();
    }

    public function deleteModal(Comment $comment)
    {
        $this->commentToBeDeleted = $comment;
        $this->showDeleteModal = true;
    }

    public function confirmCommentDelete()
    {
        $this->commentToBeDeleted->delete();
        $this->comments = $this->getComments();
        $this->commentToBeDeleted = null;
        $this->showDeleteModal = false;
    }

    public function editModal(?Comment $comment)
    {
        //$comment=null;
        if (! $comment) {
            $comment = new Comment([
                'user_id'=>$this->user->id,
                'sensor_id'=>6,

            ]);
        }
        $this->commentToBeEdited = $comment;
        $this->commentText = $comment->text;
        $this->showEditModal = true;
    }

    public function updateCommentTime()
    {
        if (! $this->commentToBeEdited->time) {
            $this->commentToBeEdited = new Comment([
                'user_id'=>$this->user->id,
                'sensor_id'=>6,
                'time'=>Carbon::createFromFormat('Y-m-d H:i', $this->date.' '.$this->loadedTime),
            ]);
        }
    }

    public function saveComment()
    {
        $this->commentToBeEdited->text = $this->commentText;
        $this->commentToBeEdited->user_id = auth()->user()->id;
        $this->commentToBeEdited->save();
        $this->showEditModal = false;

        $this->comments = $this->getComments();
    }

    public function viewModal(Comment $comment)
    {
        $this->commentToBeEdited = $comment;
        $this->commentText = $comment->text;
        $this->showEditModal = true;
        $this->editingEditModal = false;
    }

    public function updatedShowEditModal()
    {
        if (! $this->showEditModal) {
            $this->editingEditModal = true;
        }
    }

    public function render()
    {
        return view('livewire.weareble.comments');
    }
}
