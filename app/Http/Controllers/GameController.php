<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Carbon;

class GameController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tableName = 'feedback';
    }

    public function rpg()
    {
        return view('gaming');
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string',
        ]);

        $feedbackMessage = $request->input($this->tableName);

        $userName = $request->user()->name;

        $now = Carbon::now()->toDateTimeString();

        $newFeedbackRef = $this->database->getReference($this->tableName)->push([
            'message' => $feedbackMessage,
            'user_name' => $userName,
            'timestamp' => $now, 
        ]);

        return response()->json(['success' => true, 'message' => 'Feedback submitted successfully']);
    }

    public function getFeedback()
    {
        $feedback = $this->database->getReference('feedback')->getValue();
    
        return $feedback;
    }

    public function deleteFeedback($id)
    {
        $key = $id;
        $this->database->getReference($this->tableName.'/'.$key)->remove();
        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
    }    
}
