<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailAlertController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('set_alert');
    }

    // Handle form submission
    public function storeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'notif_date' => 'required|date',
        ]);

        $email = new Email;
        $email->email = $request->email;
        $email->notif_date = $request->notif_date;
        $email->save();

        return back()->with('success', 'Alert set successfully!');
    }

    public function deleteEmail(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:emails,email',
        // ]); //this is commented out because it doesn't let us show errors

        $email = Email::where('email', $request->email)->first();
        if ($email) {
            $email->delete();

            return back()->with('success', 'Alert deleted successfully!');
        }

        return back()->with('error', 'Failed to delete alert or Alert not set Yet!');
    }
}
