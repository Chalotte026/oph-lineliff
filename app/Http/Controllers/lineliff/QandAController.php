<?php

namespace App\Http\Controllers\lineliff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QandAController extends Controller
{
    protected function qa() {
        $question = 'Patinya Charoonchart';
        $answer = '084-xxx-xxxx';
        return view('QA')
            ->with(compact('question','answer'));
    }
}
