<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExplorerController extends Controller
{
    public function index()
    {
        $explorer = Explorer::all();

        return view('explorer.index', ['name' => $explorer]);
    }

    public function store(Request $request)
    {
        $explorer = new Explorer();
        $explorer->name = $request->name;
        $explorer->parent_id = $request->parent_id;

        $explorer->save();

        return redirect()->route('explorer.index')->with('message', 'Element "' . $request->name . '" dodany poprawnie');
    }

    public function updateName(Request $request)
    {
        $id = $request->id;
        $parentId = DB::table('explorers')->where('id', $id)->first();

        $explorer = Explorer::find($id);
        $explorer->name = $request->name;
        $explorer->parent_id = $parentId->parent_id;

        $explorer->save();

        return redirect()->route('explorer.index')->with('message', 'Zmieniono nazwę elementu "' . $parentId->name . '" na ' . $request->name);
    }

    public function move(Request $request)
    {
        $id = DB::table('explorers')->where('name', $request->name)->value('id');
        $parentId = DB::table('explorers')->where('id', $request->parent_id)->value('name');

        $explorer = Explorer::find($id);
        $explorer->name = $request->name;
        $explorer->parent_id = $request->parent_id;

        $explorer->save();

        return redirect()->route('explorer.index')->with('message', 'Rodzicem elementu "' . $request->name . '" jest teraz ' . $parentId);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $name = DB::table('explorers')->where('id', $id)->value('name');
        Explorer::destroy($id);
        return redirect()->route('explorer.index')->with('message', 'Węzeł '.$name.' został usunięty');
    }


}
