<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Author\StoreRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Authors';
        $authors = User::where('type', '2')->get(); // type 2 is author and type 1 is admin
        return view('admin.author.index')->with([
            'page_name' => $page_name,
            'authors' => $authors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'Author Page';
        $roles = Role::all();

        return view('admin.author.create')->with([
            'roles' => $roles,
            'page_name' => $page_name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except(['password', 'roles']);
        $data['password'] = Hash::make($request->password);
        $data['type'] = 2;
        $author = User::create($data);
        $author->syncRoles($request->roles);

        return redirect()->route('author.index')->with('success', 'Done the author has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = User::findOrFail($id);
        $selectedRoles = $author->roles()->get()->pluck('id')->toArray();
        $roles = Role::all();

        return view('admin.author.edit')->with([
            'author' => $author,
            'page_name' => 'Author Page',
            'selectedRoles' => $selectedRoles,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $author = User::findOrFail($id);
        $data = $request->except(['password']);
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $author->update($data);
        $author->syncRoles($request->roles);

        return redirect()->route('author.index')->with('success', 'Done the author has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = User::findOrFail($id);
        $role->syncRoles([]);
        $role->delete();

        return redirect()->route('author.index')->with('success', 'The author has been deleted successfully');
    }
}
