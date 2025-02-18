<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class LocentryController extends Controller
{
    public function create()
    {
        return view('locentry/index');
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'Name' => 'required|string|max:50',
            'Location' => 'required|string|max:500',
            'Latitude' => 'required|numeric|between:-90,90',
            'Longitude' => 'required|numeric|between:-180,180',
            'Price' => 'nullable|numeric|min:0',
        ]);

        // Facility モデルに保存
        Facility::create([
            'name' => $validated['Name'],
            'location' => $validated['Location'],
            'latitude' => $validated['Latitude'],
            'longitude' => $validated['Longitude'],
            'price' => $validated['Price'],
        ]);

        // 成功メッセージとリダイレクト
        return redirect()->route('form')->with('success', 'データが登録されました！');
    }
}
