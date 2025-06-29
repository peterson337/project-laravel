<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FinanceseModel;

class FinancesController extends Controller
{
    public function saveFinances(Request $request) {
        try {
            $price = $request -> input('price');
            $description = $request -> input('description');
            $type = $request -> input('type');
            $userId = Auth::id();

            $event = new FinanceseModel;
            $event -> priceTotal = $price;
            $event -> description = $description;
            $event -> type = $type;
            $event -> user_id = $userId;
            $event -> save();

        return response()->json(['message' => 'As dados foram salvos com sucesso!'], 201);
        } catch (\Exception $error) {
            return response()->json(['message' => $error -> getMessage()], 500);
        }

    }
    
     public function index()
    {
           return FinanceseModel::all();

    }

    public function deleteFinance($id) {
        FinanceseModel::findOrFail($id) -> delete();     

        return response()->json(['message' => 'As dados foram deletados com sucesso!'], 201);


    }
}
