<?php


function justify($str, $len) {
    $array=explode(" ",$str);
    $new_text="";
    $i=0;
    $newarrray=array();
    $last_entry=0;
    $string_length=0;
    foreach($array as $word){
        $string_length+=strlen($word);
        if($string_length+$i>$len){
            $old_string_length=0;
            $string_length=strlen($word);
            foreach($newarray as $word2){
                $old_string_length+=strlen($word2);
            }
            if($old_string_length+$i-1>=$len){
                $first=True;
                foreach($newarray as $word2){
                    if($first==True){
                        $new_text.=$word2;
                        $first=False;
                    }
                    else{
                        $new_text.=" ";
                        $new_text.=$word2;
                    }
                }
                $new_text.="\n";
                $newarray=array();
                $i=0;
            }
            else{
                if($i>1) {
                    $how_many_missing_spaces = $len - $old_string_length;
                    $how_many_between_words = $how_many_missing_spaces / ($i - 1);
                    $how_many_between_words = floor($how_many_between_words);
                    $how_many_extra = $len - (($i-1) * $how_many_between_words) - $old_string_length;
                }
                $first=True;
                foreach($newarray as $word2){
                    if($first==True){
                        $new_text.=$word2;
                        $first=False;
                    }
                    else{
                        for($n=0;$n<$how_many_between_words;$n++){
                            $new_text.=" ";
                        }
                        if($how_many_extra>0){
                            $new_text.=" ";
                            $how_many_extra--;
                        }
                        $new_text.=$word2;
                    }

                }
                $new_text.="\n";
                $newarray=array();
                $i=0;
            }
        }
        $newarray[$i]=$word;
        $i++;
    }
    if($i>0) {
        $old_string_length = 0;
        $string_length = strlen($word);
        foreach ($newarray as $word2) {
            $old_string_length += strlen($word2);
        }
        if ($old_string_length + $i - 1 == $len) {
            $first = True;
            foreach ($newarray as $word2) {
                if ($first == True) {
                    $new_text .= $word2;
                    $first = False;
                } else {
                    $new_text .= " ";
                    $new_text .= $word2;
                }
            }
            $new_text .= "\n";
            $newarray = array();
            $i = 0;
        } else {
            if ($i > 1) {
                $how_many_missing_spaces = $len - $old_string_length;
                $how_many_between_words = $how_many_missing_spaces / ($i - 1);
                $how_many_between_words = floor($how_many_between_words);
                $how_many_extra = $len - (($i - 1) * $how_many_between_words) - $old_string_length;
            }
            $first = True;
            foreach ($newarray as $word2) {
                if ($first == True) {
                    $new_text .= $word2;
                    $first = False;
                } else {
                    for ($n = 0; $n < $how_many_between_words; $n++) {
                        $new_text .= " ";
                    }
                    if ($how_many_extra > 0) {
                        $new_text .= " ";
                        $how_many_extra--;
                    }
                    $new_text .= $word2;
                }

            }
        }
    }
    $new_text=rtrim($new_text,"\n");
    return $new_text;
}


$text="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis dolor mauris, at elementum ligula tempor eget. In quis rhoncus nunc, at aliquet orci. Fusce at dolor sit amet felis suscipit tristique. Nam a imperdiet tellus. Nulla eu vestibulum urna. Vivamus tincidunt suscipit enim, nec ultrices nisi volutpat ac. Maecenas sit amet lacinia arcu, non dictum justo. Donec sed quam vel risus faucibus euismod. Suspendisse rhoncus rhoncus felis at fermentum. Donec lorem magna, ultricies a nunc sit amet, blandit fringilla nunc. In vestibulum velit ac felis rhoncus pellentesque. Mauris at tellus enim. Aliquam eleifend tempus dapibus. Pellentesque commodo, nisi sit amet hendrerit fringilla, ante odio porta lacus, ut elementum justo nulla et dolor.";
$length="15";

$something=justify($text,$length);


echo nl2br($something);