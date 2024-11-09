<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrcode;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource with pagination
     */
    public function index()
    {
        return Qrcode::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'data' => 'required|string',
        ]);

        $qrcode = Qrcode::create($request->all());

       return response()->json($qrcode, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Qrcode $qrcode)
    {
        return response()->json($qrcode);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qrcode $qrcode)
    {
        $request ->validate([
            'author' => 'required|string|max:255',
            'data' => 'required|string',
        ]);

        $qrcode ->update($request->all());

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
