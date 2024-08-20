<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class StripeController extends Controller
{
    public function getBillingPortal(): Response
    {
        $returnUrl = url()->previous();
        $billingPortalUrl = Auth::user()->billingPortalUrl($returnUrl);

        return Inertia::location($billingPortalUrl);
    }
}
