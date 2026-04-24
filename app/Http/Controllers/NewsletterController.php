<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        NewsletterSubscriber::firstOrCreate(['email' => $data['email']], ['is_active' => true]);

        return back()->with('success', 'Thanks for subscribing!');
    }
}
