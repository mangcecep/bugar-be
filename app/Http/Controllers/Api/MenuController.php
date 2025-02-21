<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    // Get all menu items
    public function index(): JsonResponse
    {
        $menu = Menu::all();
        return response()->json($menu);
    }

    // Create new menu item
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'olahraga' => 'required|string|max:255',
            'jenis_olahraga' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'durasi' => 'required|date_format:H:i:s',
        ]);

        $menu = Menu::create($validated);
        return response()->json($menu, 201);
    }

    // Get single menu item
    public function show($id): JsonResponse
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
        return response()->json($menu);
    }

    // Update menu item
    public function update(Request $request, $id): JsonResponse
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $validated = $request->validate([
            'olahraga' => 'sometimes|string|max:255',
            'jenis_olahraga' => 'sometimes|string|max:255',
            'deskripsi' => 'sometimes|string|max:255',
            'durasi' => 'sometimes|date_format:H:i:s',
        ]);

        $menu->update($validated);
        return response()->json($menu);
    }

    // Delete menu item
    public function destroy($id): JsonResponse
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $menu->delete();
        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
