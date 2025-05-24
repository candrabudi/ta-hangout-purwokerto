<?php

namespace App\Http\Controllers;

use App\Models\Hangout;
use App\Models\HangoutImage;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class HangoutController extends Controller
{
    public function index()
    {
        $hangouts = Hangout::with('location')
            ->withCount('images')
            ->withAvg(['visitorRatings as average_rating'], 'rating_value')
            ->get();

        return view('admin.hangouts.index', compact('hangouts'));
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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

            $coffeeShop = new Hangout();
            $coffeeShop->name = $request->name;
            $coffeeShop->slug = Str::slug($request->name);
            $coffeeShop->address = $request->address;
            $coffeeShop->description = $request->description;
            $coffeeShop->status = $request->status;
            $coffeeShop->google_maps_url = $request->google_maps_url;
            $coffeeShop->location_id = $request->location_id;
            $coffeeShop->thumbnail = $thumbnailPath;
            $coffeeShop->save();

            // Simpan gambar tambahan jika ada
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $hangoutImage = new HangoutImage();
                    $hangoutImage->hangout_id = $coffeeShop->id;
                    $hangoutImage->image_path = $image;
                    $hangoutImage->save();
                }
            }

            DB::commit();

            return redirect()->route('hangout.index')->with('success', 'Coffee Shop berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()])->withInput();
        }
    }
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
