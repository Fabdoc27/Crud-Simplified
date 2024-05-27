<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Category;
use App\Models\Location;
use App\Services\OfferService;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Gate;

class OfferController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        Gate::authorize( 'check', Offer::class );

        $categories = Category::orderBy( 'title' )->get();
        $locations  = Location::orderBy( 'title' )->get();

        return view( 'offers.create', compact( 'categories', 'locations' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( OfferRequest $request, OfferService $offerService ) {
        Gate::authorize( 'check', Offer::class );

        $offerService->store(
            $request->validated(),
            $request->hasFile( 'image' ) ? $request->file( 'image' ) : null
        );

        return redirect()->back()->with( ['success' => 'Offer created'] );
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id ) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( OfferRequest $request, string $id ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id ) {
        //
    }
}