<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class AdminTestimonialController extends Controller
{
    /**
     * Display a listing of all testimonials for admin
     */
    public function index()
    {
        $testimonials = Testimonial::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Remove the specified testimonial
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }
}