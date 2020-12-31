<?php


function isModLogin() {
        
        $role= session()->get("login_role");
        if($role != "mod") {
                return false;
        }
        return true;
}


function isMemberLogin() {
        
        $role= session()->get("login_role");
        if($role != "member") {
                return false;
        }
        return true;
}




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
        if($pic == "default.jpg") {
                return false;
        } 
        $file = storage_path()."/app/uploads/" . $pic;
        if (file_exists($file)) {
                if (File::delete($file)) {
                        return true;
                }
        }
}




function getTitleSlug($title, $required_slug) {
        $slug = explode("-", $title)[0];
        if($slug == $required_slug) {
                return "active";
        }else {
                return "";
        } 
}
