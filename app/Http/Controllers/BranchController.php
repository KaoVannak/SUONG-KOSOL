<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'logo'  => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = $request->only('name', 'email', 'phone');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('branch_logos', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        Branch::create($data);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'logo'  => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'email', 'phone');

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($branch->logo && Storage::disk('public')->exists(str_replace('storage/', '', $branch->logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $branch->logo));
            }

            $path = $request->file('logo')->store('branch_logos', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $branch->update($data);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        // Delete logo image
        if ($branch->logo && Storage::disk('public')->exists(str_replace('storage/', '', $branch->logo))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $branch->logo));
        }

        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
}
