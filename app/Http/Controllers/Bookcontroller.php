<?php

namespace App\Http\Controllers;
use App\Models\Sach;
use Illuminate\Http\Request;

class Bookcontroller extends Controller
{
    public function Showall()
    {
        // $book = Sach::join('trangthai', 'sach.id_trangthai', '=', 'trangthai.id')
        //                 ->select('sach.*', 'trangthai.tentrangthai')
        //                 ->get();
        $book = Sach::get();
        return $book;
    }
    
    public function AddBook(Request $request)
    {
        $fields = $request->validate([
            'tensach' => 'required|string',
            'id_theloai' => 'required|int',
            'id_tacgia' => 'required|int',
            'id_nxb' => 'required|int',
            'id_linhvuc' => 'required|int',
            'id_nganh' => 'required|int',
            'id_trangthai' => 'required|int',
            'gia' => 'required|int'
            
        ]);
        $book = Sach::create([
            'tensach' => $fields['tensach'],
            'id_theloai' => $fields['id_theloai'],
            'tensach' => $fields['tensach'],
            'id_tacgia' => $fields['id_tacgia'],
            'id_nxb' => $fields['id_nxb'],
            'id_linhvuc' => $fields['id_linhvuc'],
            'id_nganh' => $fields['id_nganh'],
            'id_trangthai' => $fields['id_trangthai'],
            'gia' => $fields['gia'],
        ]);

        $book = Sach::get();
        return $book;
    }

    public function UpdateBookbyID(Request $request, $id)
    {
        try{
            $book = Sach::find($id);
            $book->tensach = $request->input('tensach');
            $book->id_theloai = $request->input('id_theloai');
            $book->id_tacgia = $request->input('id_tacgia');
            $book->id_nxb = $request->input('id_nxb');
            $book->id_linhvuc = $request->input('id_linhvuc');
            $book->id_nganh = $request->input('id_nganh');
            $book->id_trangthai = $request->input('id_trangthai');
            $book->gia = $request->input('gia');

            $book->save();
            return response()->json($book);
        } catch(Exception $e){
            return response(['message' => 'khò khò', 'status' => 404]);
        }
    }

    public function SearchByName($param)
    {
        try{
            // $book = Sach::where('tensach', 'like', "%".$param."%")->select('id', 'tensach', 'gia')->get();
            $book = Sach::join('trangthai', 'sach.id_trangthai', '=', 'trangthai.id')
                            ->where('sach.tensach', 'like', "%".$param."%")
                            ->select('sach.tensach', 'trangthai.tentrangthai')
                            ->get();
            return $book;
        } catch(Exception $e){
            return response(['message' => 'khò khò', 'status' => 404]);
        }
    }

    public function SearchTrangthaiByName($param)
    {
        try{
            $book = Sach::where('tensach', 'like', "%".$param."%")->get();
            return $book;
        } catch(Exception $e){
            return response(['message' => 'khò khò', 'status' => 404]);
        }
    }

    public function SuaTrangthai(Request $request, $id)
    {
        $book = Sach::find($id);
        $book->tensach = $request->input('tensach');
        $book->id_trangthai = $request->input('id_trangthai');
        $book->gia = $request->input('gia');

        $book->save();
        return response()->json($book);
    }
}
