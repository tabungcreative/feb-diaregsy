<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupYudisiumAddRequest;
use App\Http\Requests\GroupYudisiumUpdateRequest;
use App\Models\GroupYudisium;
use App\Services\GroupYudisiumService;
use Illuminate\Http\Request;

class GroupYudisiumController extends Controller
{
    private GroupYudisiumService $groupYudisiumSerivice;

    public function __construct(GroupYudisiumService $groupYudisiumSerivice)
    {
        $this->groupYudisiumSerivice = $groupYudisiumSerivice;
    }

    public function index()
    {
        $title = 'Group Yudisium';
        $groupYudisium = GroupYudisium::paginate(10);
        return view('admin.group-yudisium.index', compact('title', 'groupYudisium'));
    }

    public function store(GroupYudisiumAddRequest $request)
    {
        try {
            $this->groupYudisiumSerivice->add($request);
            return redirect()->back()->with('success', 'Berhasil menambahkan Group Yudisium');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }

    public function active($id)
    {
        try {
            $this->groupYudisiumSerivice->active($id);
            return redirect()->back()->with('success', 'Group Yudisium Berhasil diaktifkan');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Group Yudisium Gagal diaktifkan');
        }
    }

    public function inActive($id)
    {
        try {
            $this->groupYudisiumSerivice->inActive($id);
            return redirect()->back()->with('success', 'Group Yudisium Berhasil di non aktifkan');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Group Yudisium Gagal di non aktifkan');

        }
    }

    public function edit($id) {
        $title = 'Edit Tahun Ajaran';
        $groupYudisium = GroupYudisium::find($id);
        return view('admin.group-yudisium.edit', compact('title', 'groupYudisium'));
    }

    public function update(GroupYudisiumUpdateRequest $request, $id){
        try {
            $this->groupYudisiumSerivice->update($id, $request);
            return back()->with('success', 'Berhasil mengubah group yudisium');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Group Yudisium Gagal diubah');
        }
    }

    public function delete($id){
        try {
            $this->groupYudisiumSerivice->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus group yudisium');
        }
    }
}
