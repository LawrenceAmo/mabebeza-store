<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = [
                    [
                        'name' => 'Networks',
                        'desc' => 'Networks Networks Networks Networks Networks Networks Networks Networks Networks',
                        'items' => [
                            [
                                'img' => 'aaaa',
                                'name' => '5G Standerd Uncapped',
                                'price' => 575,
                                'sale' => true,
                                'sale_price' => 549,
                            ],
                            [
                                'img' => 'aaaa',
                                'name' => '5G Pro-Fast Uncapped',
                                'price' => 749,
                                'sale' => true,
                                'sale_price' => 729,
                            ],
                    ],

                ]
            ];

            // return json_encode($products);
            $products = json_encode($products);
        return view('portal.explore.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
