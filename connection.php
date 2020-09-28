<?php 
        class connection
        {   
            public static $conn;
            
            public static function db () {
                
                    $conn = mysqli_connect("sql209.epizy.com","epiz_26843117", "hhXMtVRVW0MFb", "epiz_26843117_work");
                return $conn;
            }
        }
     

?>