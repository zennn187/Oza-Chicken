<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        // SEARCH: Mencari berdasarkan nama, email, atau phone
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // FILTER: Filter berdasarkan gender
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // FILTER: Filter berdasarkan tanggal (birthday range)
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('birthday', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('birthday', '<=', $request->end_date);
        }

        // SORTING (optional)
        $sortBy = $request->get('sort_by', 'pelanggan_id');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $dataPelanggan = $query->paginate(10)->withQueryString();

        return view('admin.pelanggan.index', compact('dataPelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'email' => 'required|email|unique:pelanggan,email',
            'phone' => 'nullable|string|max:20',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('admin.pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'email' => 'required|email|unique:pelanggan,email,' . $id . ',pelanggan_id',
            'phone' => 'nullable|string|max:20',
        ]);

        $pelanggan->update($validated);

        return redirect()->route('admin.pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}
