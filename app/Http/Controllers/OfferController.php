<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\OfferService;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Gate;

class OfferController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request, OfferService $offerService ) {
        Gate::authorize( 'viewAll', Offer::class );

        $categories = Category::orderBy( 'title' )->get();
        $locations  = Location::orderBy( 'title' )->get();

        $offers = $offerService->viewAdmin( $request->query() );

        return view( 'offers.index', compact( 'offers', 'categories', 'locations' ) );
    }

    /**
     * Display a listing of the resource.
     */
    public function myOffers( Request $request, OfferService $offerService ) {
        Gate::authorize( 'viewMine', Offer::class );

        $categories = Category::orderBy( 'title' )->get();
        $locations  = Location::orderBy( 'title' )->get();

        $offers = $offerService->viewSeller( $request->query() );

        return view( 'offers.index', compact( 'offers', 'categories', 'locations' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        Gate::authorize( 'create', Offer::class );

        $categories = Category::orderBy( 'title' )->get();
        $locations  = Location::orderBy( 'title' )->get();

        return view( 'offers.create', compact( 'categories', 'locations' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( OfferRequest $request, OfferService $offerService ) {
        Gate::authorize( 'create', Offer::class );

        $offerService->store(
            $request->validated(),
            $request->hasFile( 'image' ) ? $request->file( 'image' ) : null
        );

        return redirect()->back()->with( ['success' => 'Offer Created'] );
    }

    /**
     * Display the specified resource.
     */
    public function show( Offer $offer ) {
        $offer->load( 'author', 'categories', 'locations' );

        return view( 'offers.show', compact( 'offer' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Offer $offer ) {
        Gate::authorize( 'update', $offer );

        $categories = Category::orderBy( 'title' )->get();
        $locations  = Location::orderBy( 'title' )->get();

        return view( 'offers.edit', compact( 'offer', 'categories', 'locations' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Offer $offer, OfferRequest $request, OfferService $offerService ) {
        Gate::authorize( 'update', $offer );

        $offerService->update(
            $offer,
            $request->validated(),
            $request->hasFile( 'image' ) ? $request->file( 'image' ) : null
        );

        return redirect()->back()->with( ['success' => 'Offer Updated'] );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Offer $offer, OfferService $offerService ) {
        $offerService->destroy( $offer );

        return response( 'Offer Deleted' );
    }
}