<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::getSingleton();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $profile = Profile::first() ?? new Profile();
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // Remove old photo
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $profile->fill($data)->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
