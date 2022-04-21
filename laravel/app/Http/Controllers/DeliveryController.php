<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::all();
        \Log::debug($deliveries);

        return view("deliveries.index", [
            "deliveries" => $deliveries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliveries.create', [
            "companies" => Company::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hours' => 'required|max:30',
            'price' => 'required|max:10',
            'company_id' => 'required',
        ]);

        if ($validatedData) {
            $delivery = Delivery::create([
                'hours' => $request->hours,
                'price' => $request->price,
                'company_id' => $request->company_id,
            ]);
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('deliveries.show', $delivery)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("deliveries.create")
                ->with('error', 'ERROR uploading file: file already exists');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //Revisar que ficheroe existe en DB
        $delivery = Delivery::find($delivery->id);

        if ($delivery) {
            return view("deliveries.show", [
                "delivery" => $delivery,
            ]);
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("deliveries.index")
                ->with('error', 'ERROR indexing delivery: delivery doesnt exists');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        return view("deliveries.edit", [
            "delivery" => $delivery,
            "companies" => Company::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        $validatedData = $request->validate([
            'hours' => 'required|max:30',
            'price' => 'required|max:10',
            'company_id' => 'required',
        ]);

        if ($validatedData) {
            $delivery->update([
                'hours' => $request->hours,
                'price' => $request->price,
                'company_id' => $request->company_id,
            ]);
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('deliveries.show', $delivery)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("deliveries.create")
                ->with('error', 'ERROR uploading file: file already exists');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return redirect()->route("deliveries.index")
            ->with('success', 'delivery '.$delivery->name.' eliminada');
    }
}
