<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contacts = Contact::all();

        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',
            'content'
        ]);

        $tel = $request->only([
            'tel1',
            'tel2',
            'tel3'
        ]);

        $categories = $request->all();

        return view('confirm', compact('contact','tel', 'categories'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
            'content'
        ]);

        Contact::create($contact);

        return view('thanks');
    }
}
