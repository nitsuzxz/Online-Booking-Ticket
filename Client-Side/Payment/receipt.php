<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>SelfPrint Ticket</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
        <div class="container-fluid">

            <!--first row-->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 padding-0">
                    <center>
                    <img class="img-responsive" src="../../Asset/images/Logo.jpg" alt="pic1">
                    </center>
                </div>
            </div>


            <!--third row-->
            <div class="row">
                <!--START of column 1-->
                <div class="col-xs-12 col-sm-12 col-md-6" style="border-right: 1px solid black; padding: 0px 15px 0px 25px">

                    <!--Cinema-->
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="cinema_name">
                                Cinema Name<br>
                      
                            </p>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="hall_name">
                                Hall No<br>
                              
                            </p>
                        </div>
                    </div>

                    <hr />

             

                    <!--MovieName-->
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <p id="movie_name">
                                Movie Name<br>
                           
                            </p>
                        </div>
                    </div>

                    <hr />

                    <!--MovieTime-->
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="aired_date">
                                Movie Date<br>
                        
                            </p>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="aired_startTime">
                                Movie Time<br>
                            </p>
                        </div>
                    </div>

                    <hr />

                    <!--SeatNo-->
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="seat">
                                Seat NO.<br>
                               
                            </p>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="total_ticket">
                                Total Ticket<br>
                                <b>Normal : </b>
                                
     
                            </p>
                         
                        </div>
                    </div>

                    <hr />

                    <!--Combo-->

                </div>
                <!--END of column 1-->
                <!--START of column 2-->
                <div id="c2" class="col-xs-12 col-sm-12 col-md-6" style="padding: 20px 15px 0px 25px">
      
                
                    <div class="A">
                        <!--CardDetail-->

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-5">
                                <p><b>Payment Type</b></p>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-7 text-right">
                                <p>
                                    <b>Maybank2U</b>
                                </p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-5">
                                <p>Total</p>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-7 text-right" id="total_price">
                          
                            </div>
                        </div>



                          <hr />

                        <!--Balance-->
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-5">
                                <p><b>Summary</b></p>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-5">
                                <p>Total Paid</p>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-7 text-right" id="total_price2">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-5">
                                <p>Balance</p>
                            
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-7 text-right">
                            <b > RM0.00</b>
                            </div>
           
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-5">
                                <p>Purchased Date</p>
                            
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-7 text-right" id="purchased_Date">
                         
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-7 text-right" id="btndone">
                                <br>
                            <button onclick="navigate()">Done</button>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        


        </div>
</body>
<script>

var formData = new FormData();
var transaction_id=JSON.parse(sessionStorage.getItem("transaction_id"));
if(transaction_id==null){
  
    window.location.href = "../index.html";
}
formData.append('receipt', transaction_id);


$.ajax({ 
  url:'./payment.php',
  type: 'POST',
  data: formData,
  cache: false,
  processData: false,
  contentType: false,
  success: function (data){

    var receipt_data=JSON.parse(data);
    
    console.log("data"+ receipt_data);

    for(var i=0;i<receipt_data.length;i++){

        var cinema_name = document.getElementById(""+receipt_data[i].cinema_name+"");
        var hall_name = document.getElementById(""+receipt_data[i].hall_name+"");
        var movie_name = document.getElementById(""+receipt_data[i].movie_name+"");
        var aired_date = document.getElementById(""+receipt_data[i].aired_date+"");
        var movie_time = document.getElementById(""+receipt_data[i].aired_startTime+"");
        var seat = document.getElementById("seat");
        var total_ticket = document.getElementById(""+receipt_data[i].total_ticket+"");
        
        var purchased_Date = document.getElementById(""+receipt_data[i].date+"");
      


 
        if(cinema_name){
            console.log("exist");
        }else{
            console.log("create ="+receipt_data[i]);
            $("#cinema_name").append(" <b id='"+receipt_data[i].cinema_name+"'>"+receipt_data[i].cinema_name+"</b>")
        }

        if(hall_name){
            console.log("exist");
        }else{
            
            $("#hall_name").append(" <b id='"+receipt_data[i].hall_name+"'>"+receipt_data[i].hall_name+"</b>")
        }
        if(movie_name){
            console.log("exist");
        }else{
            
            $("#movie_name").append(" <b id='"+receipt_data[i].movie_name+"'>"+receipt_data[i].movie_name+"</b>")
        }
        if(aired_date){
            console.log("exist");
        }else{
            
            $("#aired_date").append(" <b id='"+receipt_data[i].aired_date+"'>"+receipt_data[i].aired_date+"</b>")
        }
        if(movie_time){
            console.log("exist");
        }else{
            
            $("#aired_startTime").append(" <b id='"+receipt_data[i].aired_startTime+"'>"+receipt_data[i].aired_startTime+"</b>")
        }
   
            $("#seat").append(" <b>"+receipt_data[i].seat_row+"-"+receipt_data[i].seat_number+"</b>")
        
        if(total_ticket){
            console.log("exist");
        }else{
            
            $("#total_ticket").append(" <b id='"+receipt_data[i].total_ticket+"'>"+receipt_data[i].total_ticket+"</b>")
           
        }
        var total_price = document.getElementById(""+receipt_data[i].total_price+"");

        if(total_price){
            console.log("exist2");
        }else{
            
            $("#total_price").append(" <b id='"+receipt_data[i].total_price+"'> RM"+receipt_data[i].total_price+".00</b>")
            $("#total_price2").append(" <b id='"+receipt_data[i].total_price+"'> RM"+receipt_data[i].total_price+".00</b>")
           
        }
        if(purchased_Date){
            console.log("exist");
        }else{
            
            $("#purchased_Date").append(" <b id='"+receipt_data[i].date+"'>"+receipt_data[i].date+"</b>")
           
        }
        
   

    }

   

    
  },
    error: function(x,e){
    alert(x+e);
    }
});


function navigate(){
    sessionStorage.removeItem("transaction_id");
    sessionStorage.removeItem("selectedSeat");
    sessionStorage.removeItem("airedID");

      window.location.href = "../index.html";
}
</script>
</html>
