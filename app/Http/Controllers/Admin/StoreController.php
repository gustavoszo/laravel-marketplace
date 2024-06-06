<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadTrait;

class StoreController extends Controller
{   

    use UploadTrait;

    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index() {
        $store = auth()->user()->store;

        return view('admin.stores.index', ['store'=> $store]);
    }

    public function create() {

        $users = User::all(['id', 'name']);

        return view('admin.stores.create', ['users'=> $users]);
    }

    public function store(StoreRequest $request) {
       
        $data = $request->all();

        if($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $user = auth()->user();
        $user->store()->create($data);

        return redirect()->route('admin.stores.index')->with('success', 'Loja criada com sucesso');

    }

    public function edit($id) {

        $store = Store::find($id);
        
        return view('admin.stores.edit', ['store'=> $store]);
    }

    public function update(StoreRequest $request, $id) {

        $data = $request->all();
        $store = Store::find($id);

        if($request->hasFile('logo')) {
            if(Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        return redirect()->route('admin.stores.index')->with('success', 'Loja atualizada com sucesso');

    }

    public function destroy($id) {
        
        $store = Store::find($id);
        $store->delete();

        return redirect()->route('admin.stores.index')->with('warning', 'Loja deletada com sucesso');

    }

}
