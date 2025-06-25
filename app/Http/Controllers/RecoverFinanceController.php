<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FinanceseModel;

class RecoverFinanceController extends Controller
{
    public function index()
    {
        dump(FinanceseModel::all());
    }
}
