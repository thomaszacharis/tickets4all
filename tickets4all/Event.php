<?php
    class Event {
    /* Member variables */
        var $id;
        var $title;        
        var $description;
        var $time;
        var $date;  
        var $venueid; 
        var $venuename;     
        var $ticketprice;
        var $availability;
        var $image;
        var $duration;

        function __construct( $par1, $par2, $par4, $par5, $par6, $par7, $par8, $par9, $par10) {
            $this->id = $par1;
            $this->title = $par2;
            $this->description = $par4;
            $this->time = $par5;
            $this->date = $par6;    
            $this->venueid = $par7;        
         // $this->ticketprice = $par8;
            $this->availability = $par8;
            $this->image = $par9;
            $this->duration = $par10;
        }
		
		
        function getEventID(){
            return $this->id;
        }
        
        /* Member functions */
        function setTitle($par){
            $this->title = $par;
        }
        
        function getTitle(){     
            return $this->title;
        }
            
        function setDescription($par){
            $this->description = $par;
        }

        function getDescription(){
            return $this->description;
        }
        
        function getTime(){
            return $this->time;
        }

        function getDate(){
            return $this->date;
        }

        function getVenueID(){
            return $this->venueid;
        }

        function getVenueName(){
            return $this->venuename;
        }

        function setVenueName($par){
            $this->venuename = $par;
        }

        function getTicketPrice(){
           return $this->ticketprice;
        }
		
		function setTicketPrice($par){
            $this->ticketprice = $par;
        }

        function getImage(){
            return $this->image;
        }

        // function debug_to_console( $data ) {
        // $output = $data;

        // if ( is_array( $output ) )
        //     $output = implode( ',', $output);

        // echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        // }
    }
?>