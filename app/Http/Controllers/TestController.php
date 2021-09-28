<?php

namespace App\Http\Controllers;

use App\DataTables\TestDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(TestDataTable $dataTable)
    {
//        dd(User::all());
        return $dataTable->render('dashboard.index');
    }
}
