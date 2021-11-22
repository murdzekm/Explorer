<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ExplorerController extends Controller
{
    public function index()
    {
        $explorer = Explorer::all();
        $data = array();
        foreach ($explorer as $row) {

            $parent_id = $row->parent_id;
            if($parent_id == '0') $parent_id = "#";

            $selected = false;$opened = false;
            if($row['id'] == 2){
                $selected = true;$opened = true;
            }
            $data[] = array(
                "id" => $row->id,
                "parent" => $parent_id,
                "text" => $row->name,
                "state" => array("selected" => $selected,"opened"=>$opened)
            );
        }



//            $sub_data["id"] = $row->id;
//            $sub_data["name"] = $row->name;
//            $sub_data["text"] = $row->name;
//            $sub_data["parent_id"] = $row->parent_id;
//            $data[] = $sub_data;
//        }
//        foreach ($data as $key => &$value) {
//            $output[$value["id"]] = &$value;
//        }
//        foreach ($data as $key => &$value) {
//            if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
//                $output[$value["parent_id"]]["nodes"][] = &$value;
//            }
//        }
//        foreach ($data as $key => &$value) {
//            if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
//                unset($data[$key]);
//            }
//        }

        return view('explorer.index', ['name' => $explorer, 'data' => $data]);
    }


    public function store(Request $request)
    {

        $explorer = new Explorer();
        $explorer->name = $request->name;
        $explorer->parent_id = $request->parent_id;
        $data = Explorer::all()->count();

        if($request->parent_id === 'Wybierz..' && empty($data) ){
            $explorer->parent_id = 0;
        }elseif ($request->parent_id === 'Wybierz..'){
            $explorer->parent_id = 1;
        }
        $explorer->save();

        return redirect()->route('explorer.index')->with('message', 'Element "' . $request->name . '" dodany poprawnie');
    }

    public function updateName(Request $request)
    {

        $id = DB::table('explorers')->where('name', $request->name)->value('id');
        $parentId = DB::table('explorers')->where('id', $id)->first();

        $explorer = Explorer::find($id);
        $explorer->name = $request->newName;
        $explorer->parent_id = $parentId->parent_id;
        $explorer->save();

        $message = 'Zmieniono nazwę elementu "' . $request->name . '" na "' . $parentId . '"';

        return redirect()->route('explorer.index')->with('message', $message);
    }

    public function move(Request $request)
    {
        $id = DB::table('explorers')->where('name', $request->name)->value('id');
        $parentId = DB::table('explorers')->where('id', $request->parent_id)->value('name');

        $explorer = Explorer::find($id);
        $explorer->name = $request->name;
        $explorer->parent_id = $request->parent_id;

        if ($id == 1) {
            $message = "Nie można zmienić elementu który jest korzeniem.";
        } else {
            $explorer->save();
            $message = 'Rodzicem elementu "' . $request->name . '" jest teraz ' . $parentId;
        }


        return redirect()->route('explorer.index')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $name = DB::table('explorers')->where('id', $id)->value('name');
        Explorer::destroy($id);
        return redirect()->route('explorer.index')->with('message', 'Węzeł ' . $name . ' został usunięty');
    }


}
