<?php

class Viewer{
    
    public static function checkthview($content,$place=0,$action=0,$url='') {
        $start="(load)https://www.youtube.com/watch?v=";
        $end="(/load)";  
        $apot=Ytube::get_string_between($content, $start, $end);
        if($apot==0){
            $answer=0;
        } else{
            $answer=1;
        }
        switch ($answer) {
            case 0:
                
                switch ($place) {
                    case 'thread':
                        
                        
                        


                        break;
                    case 'post':
                        
                        switch ($action) {
                            case 'latest':


                                break;

                            default:
                                break;
                        }
                        
                        
                        


                        break;

                    default:
                        break;
                }


                break;
            

            default:
                switch ($place) {
                    case 'thread':
                        
                        
                        


                        break;
                    case 'post':
                        
                        switch ($action) {
                            case 'latest':


                                break;

                            default:
                                break;
                        }
                        
                        
                        


                        break;

                    default:
                        break;
                }
                break;
        }       
       
       
       
       
       
       
    }
    
}
