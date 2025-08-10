<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TallaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tallas = Talla::paginate();

        return view('talla.index', compact('tallas'))
            ->with('i', ($request->input('page', 1) - 1) * $tallas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $talla = new Talla();

        return view('talla.create', compact('talla'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TallaRequest $request): RedirectResponse
    {
        Talla::create($request->validated());

        return Redirect::route('tallas.index')
            ->with('success', 'Talla created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $talla = Talla::find($id);

        return view('talla.show', compact('talla'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $talla = Talla::find($id);

        return view('talla.edit', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TallaRequest $request, Talla $talla): RedirectResponse
    {
        $talla->update($request->validated());

        return Redirect::route('tallas.index')
            ->with('success', 'Talla updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Talla::find($id)->delete();

        return Redirect::route('tallas.index')
            ->with('success', 'Talla deleted successfully');
    }
}
