<?php
class Ytube {
    public static function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return 0;
        
        }
        $iniendcheck = strpos($string, $end);
        if ($iniendcheck == 0) {
            return 0;
        
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
     public static function translateyoutube($content){
        $start="(load)https://www.youtube.com/watch?v=";
        $end="(/load)";  
        $apot=Ytube::get_string_between($content, $start, $end);
        
        while ($apot!==0) {
            $finalst='<p><iframe style="border:none; overflow: hidden;" width="420" height="315"src="https://www.youtube.com/embed/';
            $finalend='?autoplay=0"></iframe></p>';
            $content=str_replace("$start","$finalst",$content);
            $content=str_replace("$end","$finalend",$content);
            $apot=Ytube::get_string_between($content, $start, $end);

        }
        return $content;
        
    }
    public static function translateyoutubepost($content){
        $start="(load)https://www.youtube.com/watch?v=";
        $end="(/load)";  
        $apot=Ytube::get_string_between($content, $start, $end);
        
        while ($apot!==0) {
            $finalst='<iframe style="border:0; overflow:hidden;" width="150" height="110"src="https://www.youtube.com/embed/';
            $finalend='?autoplay=0"></iframe>';
            $content=str_replace("$start","$finalst",$content);
            $content=str_replace("$end","$finalend",$content);
            $apot=Ytube::get_string_between($content, $start, $end);

        }
        return $content;
        
    }
}
