<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExplorerController extends Controller
{
    public function index()
    {
        $data = [];
        $explorer = Explorer::all();
        foreach ($explorer as $row) {
            $parent_id = $row->parent_id;
            if ($parent_id == '0') $parent_id = "#";
            $selected = false;
            $opened = false;
            if ($row->id == 1) {
                $selected = true;
                $opened = true;
            }
            $data[] = [
                "id" => $row->id,
                "parent" => $parent_id,
                "text" => $row->name,
                "state" => [
                    "selected" => $selected,
                    "opened" => $opened
                ]
            ];
        }
        return view('explorer.index', ['name' => $explorer, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $response = DB::table('explorers')->where('id', $request->parent_id)->value('name');

        $explorer = new Explorer();
        $explorer->name = $request->name;
        $data = Explorer::all()->count();

        if ($request->parent_id == 1 && empty($data) ) {
            $explorer->parent_id = 0;
        } elseif ($request->parent_id == 1) {
            $explorer->parent_id = 1;
        }

        if (!$response && empty($data)) {
            $explorer->save();
            $message = "Element \" $request->name \" dodany poprawnie";
        }elseif (!$response){
            $message = "Nie można zapisać elementu";
        } else {
            $explorer->parent_id = $request->parent_id;
            $explorer->save();
            $message = "Element \" $request->name \" dodany poprawnie";
        }
        return redirect()->route('explorer.index')->with('message', $message);
    }

    public
    function updateName(Request $request)
    {

        $response = DB::table('explorers')->where('name', $request->name)->value('id');
        $name = $request->name;
        if (!$response) {
            $message = "Brak elementu o nazwie \"$name\", proszę wybrać element ze struktury";
        } else {
            $id = $request->id;
            $explorer = Explorer::find($id);
            $explorer->name = $request->new;
            $explorer->save();

            $message = "Zmieniono nazwę elementu \"$name\" na  \"$request->new\"";
        }
        return redirect()->route('explorer.index')->with('message', $message);
    }

    public
    function move(Request $request)
    {
        $response = DB::table('explorers')->where('name', $request->name)->value('id');

        if (!$response) {
            $message = "Brak elementu o nazwie \"$request->name\", proszę wybrać element ze struktury";
        } else {
            $id = $request->id;
            $parentId = DB::table('explorers')->where('id', $request->parent_id)->value('name');

            $explorer = Explorer::find($id);
            $name = $explorer->name;
            $explorer->parent_id = $request->parent_id;

            if ($id == 1) {
                $message = "Nie można zmienić elementu który jest korzeniem.";
            } else {
                $explorer->save();
                $message = "Rodzicem elementu \"$name\"  jest teraz  $parentId";
            }
        }
        return redirect()->route('explorer.index')->with('message', $message);
    }

    public
    function delete(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        if (!$name) {
            $message = "Element nie został wybrany";
        } elseif ($id == 1) {
            $message = "Nie można usunąć korzenia";
        } else {
            $check = $this->hasChilds($id);
            if ($check) {
                $message = "Węzeł \"$name\" został usunięty'";
            } else {
                $message = "Wystąpił błąd podczas usuwania węzła";
            }
        }
        return redirect()->route('explorer.index')->with('message', $message);
    }

    private
    function hasChilds($id)
    {
        $query = DB::table('explorers')->where('parent_id', $id)->get();
        foreach ($query as $result) {
            $this->hasChilds($result->id);
        }
        Explorer::destroy($id);
        if (!$query->count()) {
            return true;
        }
    }
}
