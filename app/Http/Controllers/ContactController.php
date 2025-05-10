<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactInfo = [
            'address' => 'Samirono RT009/RW002, Ds. Samirono, Kec. Getasan, Kab. Semarang, Prov. Jawa Tengah',
            'phones' => [
                '+62819-0495-8282',
                '+62831-0833-2547',
                '+62812-1654-8295'
            ],
            'emails' => [
                'pokdarwissamirono@gmail.com',
            ],
            'social_media' => [
                'tiktok' => 'https://www.tiktok.com/@desawisata_samirono',
                'instagram' => 'https://www.instagram.com/desawisatasamirono/',
                'youtube' => 'https://www.youtube.com/@desawisata_samirono'
            ],
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d623.1516518382555!2d110.47286386533673!3d-7.38007418202925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a79ae04b3fb53%3A0xf05a3aedd8047367!2sDesa%20Wisata%20Samirono!5e0!3m2!1sid!2sid!4v1738379500054!5m2!1sid!2sid'
        ];

        return view('contact', compact('contactInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
