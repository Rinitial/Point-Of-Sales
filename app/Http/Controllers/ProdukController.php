<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProdukService;
use PDF;

class ProdukController extends Controller
{

    protected $ProdukService;

    public function __construct(ProdukService $ProdukService)
    {
        $this->ProdukService = $ProdukService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = $this->ProdukService->index();

        return view('produk.index', compact('kategori'));
    }

    public function data()
    {
        $produk = $this->ProdukService->all();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                    <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
                ';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="label label-success">'. $produk->kode_produk .'</span>';
            })
            ->addColumn('harga_beli', function ($produk) {
                return format_uang($produk->harga_beli);
            })
            ->addColumn('harga_jual', function ($produk) {
                return format_uang($produk->harga_jual);
            })
            ->addColumn('stok', function ($produk) {
                return format_uang($produk->stok);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="btn-group">
                    <button onclick="deleteData(`'. route('produk.destroy', $produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_produk', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $produk = Produk::create($request->all());
        $produkl = $this->ProdukService->latest();
        $request['kode_produk'] = 'P'. tambah_nol_didepan($produkl->id_produk +1, 6);
        
        $data = $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'kode_produk' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'diskon' => 'required',
            'stok' => 'required'
        ]);

        
        $produk = $this->ProdukService->create($data);     
        
        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = $this->ProdukService->find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'nama_produk',
            'id_kategori',
            'merk',
            'harga_beli',
            'harga_jual',
            'diskon',
            'stok',
        ]);

        $produk = $this->ProdukService->update($data, $id);

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $produk = Produk::find($id);
        // $produk->delete();

        $this->ProdukService->delete($id);

        return response(null, 204);
    }
    
    public function deleteSelected(Request $request) 
    {
        // foreach ($request->id_produk as $id) {
        //     $produk = Produk::find($id);
        //     $produk->delete();
        // }

        $this->ProdukService->deleteSelected($request);

        return response(null, 204);
    }

public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        $this->ProdukService->cetakBarcode($request);

        $no  = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }
}
