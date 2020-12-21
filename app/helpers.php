<?php




function activePolls() {
        $polls= \App\Models\Poll::where("active", "=", "1")->get();
        return $polls;
}


function memberAllowedToVote($member, $poll) {
        $poll_voter= \App\Models\PollVoters::where([["member_id", "=", $member->id], ["poll_id", "=", $poll->id]])->get();
        if(count($poll_voter) > 0) {
                return false;
        }else {
                return true;
        } 
} 


function isAnyPollsToVote() {
        $active_polls= activePolls();
        if(count($active_polls) > 0) {
                foreach($active_polls as $poll) {
                        if(memberAllowedToVote(session()->get("user"), $poll)) {
                                return true;
                        } 
                } 
        }else {
                return false;
        } 

        return false;
} 


function fromEasternArabicToWestern($str) {
        $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
        $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        
        $str = str_replace($eastern_arabic, $western_arabic, $str);
        return $str;
} 





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
