<?php 
        class connection
        {   
            public static $conn;
            
            public static function db () {
                
                    $conn = mysqli_connect("localhost","root", "rootpass", "db1");
                return $conn;
            }
        }
     

?>