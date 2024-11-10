<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrcode;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource with pagination and search features.
     */
    public function index(Request $request)
{
    $query = Qrcode::query();

    if ($request->has('author') && $request->author) {
        $query->where('author', 'like', '%' . $request->author . '%');
    }

    if ($request->has('data') && $request->data) {
        $query->where('data', 'like', '%' . $request->data . '%');
    }

    return response()->json($query->paginate(), 200);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'author' => 'required|string|max:255',
            'data' => 'required|string',
        ]);

        $qrcode = Qrcode::create($validatedData);

        return response()->json($qrcode, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Qrcode $qrcode)
    {
        return response()->json($qrcode, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qrcode $qrcode)
    {
        $validatedData = $request->validate([
            'author' => 'required|string|max:255',
            'data' => 'required|string',
        ]);

        $qrcode->update($validatedData);

        return response()->json($qrcode, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qrcode $qrcode)
    {
        $qrcode->delete();

        return response()->json(null, 204);
    }
}

