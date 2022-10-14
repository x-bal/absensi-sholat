<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::latest()->limit(500)->get();
        $title = 'History Device';

        return view('history.index', compact('histories', 'title'));
    }
}
