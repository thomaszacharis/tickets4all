<?php
    class Booking {
    /* Member variables */
        var $id;
        var $userid;        
        var $eventid;
        var $eventTitle;
        var $ticketsamount = 0;
        var $eventTicketPrice = 0;

        function __construct( $par1, $par2, $par3, $par4) {
            $this->id = $par1;
            $this->userid = $par2;
            $this->eventid = $par3;
            $this->ticketsamount = $par4;          
        }

        function getBookingID(){
            return $this->id;
        }

        function getUserID(){
            return $this->userid;
        }

        function getEventID(){
            return $this->eventid;
        }        
                
        function setEventTitle($par){
            $this->eventTitle = $par;
        }
        
        function getEventTitle(){     
            return $this->eventTitle;
        }                    
                

        function getTicketsAmount(){
            return $this->ticketsamount;
        }

        function setEventTicketPrice($par){
            $this->eventTicketPrice = $par;
        }

        function getSumPrice(){
            return $this->ticketsamount * $this->eventTicketPrice;
        }
       
    }
?>