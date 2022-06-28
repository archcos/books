<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Traits\ApiResponser;
use DB;

Class BookController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function index(){

        $book = Book::all();

        return $this->successResponse($book);
    }

    public function add(Request $request){

            $rules = [
              'bookname' => 'required|max:150',
              'yearpublish' => 'required|max:4',
              'authorid' => 'required|numeric|min:1|not_in:0',
             ];

            $this->validate($request, $rules);
            $book = Book::create($request->all());
            return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function show($id){
       
        $book = Book::where('id', $id)->first();
        if($book){
            return $this->successResponse($book);
        }

            return $this->errorResponse("Book id not found", Response::HTTP_NOT_FOUND);
        }

   public function update(Request $request,$id)
        {
           $rules = [
            'bookname' => 'max:150',
            'yearpublish' => 'max:4',
            'authorid' => 'numeric|min:1|not_in:0',
           ];
       
           $this->validate($request, $rules);
       
           $book = Book::findOrFail($id);
       
           $book->fill($request->all());
       
           if ($book->isClean()) {
               return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
           }
       
           $book->save();
           return $this->successResponse($book);
        }


    public function delete($id, Request $request)
        {
            $book = Book::findOrFail($id);
            $book->delete($request->all());

            return $this->successResponse($book, Response::HTTP_OK);
        }

}