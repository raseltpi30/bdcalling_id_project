<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    private static $country;

    protected $table = 'countries';

    protected $fillable = ['name', 'image'];

    /**
     * Create or update a Country item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public static function newItem($request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id' => 'nullable|integer|exists:countries,id',
        ]);

        // Check if the country exists by name
        $country = self::where('name', $validatedData['name'])->first();

        if ($country) {
            // Update the existing country if the ID matches or if it's provided in the request
            if ($request->has('id') && $country->id == $request->id) {
                if ($request->hasFile('image')) {
                    // Delete old image if a new one is uploaded
                    Storage::disk('public')->delete($country->image);
                    $imagePath = $request->file('image')->store('countries', 'public');
                    $validatedData['image'] = $imagePath;
                }
                $country->update($validatedData);
                return 'Country ' . $country->name . ' updated successfully.';
            } else {
                return 'Country name already exists.';
            }
        } else {
            // Create a new country if name doesn't exist
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->move('upload/country-images/');
                $validatedData['image'] = $imagePath;
            }
            $country = self::create($validatedData);
            return 'Country ' . $country->name . ' created successfully.';
        }
    }

    /**
     * Accessor to get the full URL of the image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return move('upload/country-images/')->url($this->image);
    }


    public static function  deleteItem($id)
    {
        self::$country = Teacher::find($id);
        if (file_exists(self::$country->image))
        {
            unlink(self::$country->image);
        }
        self::$country->delete();
        return 'Country  Delete successfully.';
    }
}
