<?php

function deletePicFromDisk($pic) {
        
}



//     public function deleteImage($image_id = null){

//         if ($image_id != null) {
//             $file = \App\ProjectImage::where("uri",$image_id)->first();
//             if ($file != null) {
//                 $file->delete();
//             }
                  
//         }
        
//         $file = storage_path()."/app/uploads/" . $image_id;
//         if (file_exists($file)) {
//             if (File::delete($file)) {
//                 return response()->json([
//                     "status"=> "success",
//                     "message"=> "the file $image_id deleted successfully"
//                 ])->setStatusCode(200);
//             }
//         }else{
//             return response()->json([
//                 "status" => "error",
//                 "message" => "No such file found!"
//             ])->setStatusCode(404);
//         }
//     }
// }

?>
