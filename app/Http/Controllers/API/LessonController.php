<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Resources\lesson as LessonResource;

class LessonController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index','show']);
      }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lesson= LessonResource::collection(Lesson::all());
        return  response()->json($lesson, 200)->header('Additional Header','True');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try {
        $lesson = new LessonResource(Lesson::create($request->all()));
        return response()->json($lesson, 200);
         } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500); // هنا اذا حدثت مشكله سيخبرك ما هو الخطأ
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = new LessonResource(Lesson::findOrFail($id));
        return  response()->json($lesson, 200)->header('Additional Header','True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lesson =new LessonResource(Lesson::findOrFail($id));
        $lesson->update($request->all());
        return response()->json($lesson, 200)->header('Additional Header','True');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();
        return 204;
    }
        /*
        الدالة اني تعيد الرسالة في حالة المستخدم طلب الروت لسن 
       Route::any('lesson', function () {
           return "please make sure to update your code to use the newer version of our API.
           you should use lessons instead of lesson";
       });
       الدالة ري ديركت تعيد لسنس حتى لو المستخدم طلب الدالةلسن 
       Route::redirect('lesson','lessons');
       الموجة الذي تم انشاءة اخرا يتم تنفيذه اولا
      */  

}
