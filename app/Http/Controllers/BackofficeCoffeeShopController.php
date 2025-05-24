<?php

namespace App\Http\Controllers;

use App\Models\HangoutImage;
use App\Models\Hangout;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackofficeCoffeeShopController extends Controller
{
    public function index()
    {
        $coffeeShops = Hangout::with('location')
            ->withCount('images')
            ->withAvg('ratings', 'rating')
            ->get()
            ->map(function ($shop) {
                $shop->average_rating = $shop->ratings_avg_rating ?? 0;
                return $shop;
            });

        return view('admin.hangouts.index', compact('coffeeShops'));
    }

    public function create()
    {
        $locations = Location::all();

        return view('admin.hangouts.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'google_maps_url' => 'nullable|url',
            'location_id' => 'required|exists:locations,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        $coffeeShop = Hangout::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
            'google_maps_url' => $request->google_maps_url,
            'location_id' => $request->location_id,
            'thumbnail' => $thumbnailPath,
        ]);

        if ($request->images) {
            foreach ($request->images as $image) {
                HangoutImage::create([
                    'coffee_shop_id' => $coffeeShop->id,
                    'image_path' => $image,
                ]);
            }
        }

        return redirect()->route('admin.hangouts.index')->with('success', 'Coffee Shop berhasil ditambahkan!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('coffee_shop_images', $filename, 'public');

        return response()->json(['name' => $path]);
    }

    public function edit($id)
    {
        $coffeeShop = Hangout::with('images')->findOrFail($id);
        $locations = Location::all();
        $coffeeShopImages = $coffeeShop->images;
        return view('admin.hangouts.edit', compact('coffeeShop', 'locations', 'coffeeShopImages'));
    }

    public function update(Request $request, $id)
    {
        $coffeeShop = Hangout::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'google_maps_url' => 'nullable|url',
            'location_id' => 'required|exists:locations,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'address', 'description', 'status', 'google_maps_url', 'location_id']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            if ($coffeeShop->thumbnail && Storage::disk('public')->exists($coffeeShop->thumbnail)) {
                Storage::disk('public')->delete($coffeeShop->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $coffeeShop->update($data);

        if ($request->images) {
            foreach ($request->images as $image) {
                HangoutImage::create([
                    'coffee_shop_id' => $coffeeShop->id,
                    'image_path' => $image,
                ]);
            }
        }

        return redirect()->route('hangout.index')->with('success', 'Coffee Shop berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $coffeeShop = Hangout::with('images')->findOrFail($id);

        if ($coffeeShop->thumbnail && Storage::disk('public')->exists($coffeeShop->thumbnail)) {
            Storage::disk('public')->delete($coffeeShop->thumbnail);
        }

        foreach ($coffeeShop->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $coffeeShop->delete();

        return redirect()->route('hangout.index')->with('success', 'Coffee Shop berhasil dihapus!');
    }

    public function destroyImage(HangoutImage $image)
    {
        $path = storage_path('app/public/' . $image->image_path);
        if (File::exists($path)) {
            File::delete($path);
        }

        $image->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus');
    }



}
