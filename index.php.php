<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php 
    session_start();
    //connect to database
    include("../connect.php");
?>
<?php
            if(isset($_POST["submit"])){
                    $recordID= $_POST["recordId"];
                    $partID= $_POST["partId"];
                    $eventID= $_POST["eventId"];
                    $eventName= $_POST["eventname"];
                    $ticketID= $_POST["ticketId"];
                    $ticketQTY= $_POST["ticketQty"];
                    $ticketPrice= $_POST["ticketPrice"];
                    $eventDesc= $_POST["eventDesc"];
                    {

                            //check variables and compare  from database
                            $sql="SELECT recordID FROM record WHERE recordID='$recordID'";


                            $result= mysqli_query($sambung,$sql);


                    if(mysqli_num_rows($result)==1){
                            //if registered
                                    echo "<script>alert('Duplicate data detected.Try Again.');
                                    window.location='search,view and manage.php'</script>";
                                    }
                            //store new record
                            else{
                            //store new data to database
                                    $query = mysqli_query($connect,"INSERT INTO record
                                    (IDBilik,NamaBilik,Kapasiti)VALUES
                                    ('$recordID','$partID','$eventID','$eventName','$ticketID','$ticketQTY','$ticketPrice','$eventDesc')");
                                    if($query){
                                    echo "<script>alert('Record Added. ');
                                    window.location='search,view and manage.php' </script>";

                                    }
                            }	
                    }
            }
 ?>


<html>
    <!----------------------javascript------------------------->
    <script type="text/javascript">
    
    var selectedRow = null

        function onFormSubmit(e) {
                event.preventDefault();
                var formData = readFormData();
                if (selectedRow == null){
                    if (confirm('Do you want to confirm this record?')) {
                    insertNewRecord(formData);
                    }
                }
                else{
                    updateRecord(formData);
                        }
                resetForm();    
        }

        //Retrieve the data
        function readFormData() {
            var formData = {};
            formData["recordId"] = document.getElementById("recordId").value;
            formData["partId"] = document.getElementById("partId").value;
            formData["eventId"] = document.getElementById("eventId").value;
            formData["eventname"] = document.getElementById("eventname").value;
            formData["ticketId"] = document.getElementById("ticketId").value;
            formData["ticketQty"] = document.getElementById("ticketQty").value;
            formData["ticketPrice"] = document.getElementById("ticketPrice").value;
            formData["eventDesc"] = document.getElementById("eventDesc").value;
            return formData;
        }

        //Insert the data
        function insertNewRecord(data) {
            var table = document.getElementById("bookList").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.length);
            cell0 = newRow.insertCell(0);
                        cell0.innerHTML = data.recordId;
            cell1 = newRow.insertCell(1);
                        cell1.innerHTML = data.partId;
            cell2 = newRow.insertCell(2);
                        cell2.innerHTML = data.eventId;
            cell3 = newRow.insertCell(3);
                        cell3.innerHTML = data.eventname;
            cell4 = newRow.insertCell(4);
                        cell4.innerHTML = data.ticketId;
            cell5 = newRow.insertCell(5);
                        cell5.innerHTML = data.ticketQty;
            cell6 = newRow.insertCell(6);
                        cell6.innerHTML = data.ticketPrice;
            cell7 = newRow.insertCell(7);
                        cell7.innerHTML = data.eventDesc;
            cell8 = newRow.insertCell(8);
                cell8.innerHTML = `<button onClick="onEdit(this)">Edit</button> <button onClick="onDelete(this)">Remove</button>`;
        }

        //Edit the data
        function onEdit(td) {
            selectedRow = td.parentElement.parentElement;
            document.getElementById("recordId").value = selectedRow.cells[0].innerHTML;
            document.getElementById("partId").value = selectedRow.cells[1].innerHTML;
            document.getElementById("eventId").value = selectedRow.cells[2].innerHTML;
            document.getElementById("eventname").value = selectedRow.cells[3].innerHTML;
            document.getElementById("ticketId").value = selectedRow.cells[4].innerHTML;
            document.getElementById("ticketQty").value = selectedRow.cells[5].innerHTML;
            document.getElementById("ticketPrice").value = selectedRow.cells[6].innerHTML;
            document.getElementById("eventDesc").value = selectedRow.cells[7].innerHTML;
        }
        
        function updateRecord(formData) {
            selectedRow.cells[0].innerHTML = formData.recordId;
            selectedRow.cells[1].innerHTML = formData.partId;
            selectedRow.cells[2].innerHTML = formData.eventId;
            selectedRow.cells[3].innerHTML = formData.eventname;
            selectedRow.cells[4].innerHTML = formData.ticketId;
            selectedRow.cells[5].innerHTML = formData.ticketQty;
            selectedRow.cells[6].innerHTML = formData.ticketPrice; 
            selectedRow.cells[7].innerHTML = formData.eventDesc;
        }

        //Remove the data
        function onDelete(td) {
            if (confirm('Do you want to remove this record?')) {
                row = td.parentElement.parentElement;
                document.getElementById('bookList').deleteRow(row.rowIndex);
                resetForm();
            }
        }

            function myFunction(){  
            var a = document.forms["myForm"]["recordId"].value;
            var b = document.forms["myForm"]["partId"].value;
            var c = document.forms["myForm"]["eventId"].value;
            var d = document.forms["myForm"]["eventname"].value;
            var e = document.forms["myForm"]["ticketId"].value;
            var f = document.forms["myForm"]["ticketQty"].value;
            var g = document.forms["myForm"]["ticketPrice"].value;
            var h = document.forms["myForm"]["eventDesc"].value;

            if (a == "") {
                document.getElementById('errorrecordId').innerHTML="Please Enter Your Record ID.";
                return false;
            }
            else if (b == "") {
                document.getElementById('errorpartId').innerHTML="Please Enter Participant ID.";
                document.getElementById('errorrecordId').innerHTML="";
                return false;
            }
            else if (c == "") {
                document.getElementById('erroreventId').innerHTML="Please Enter Event ID.";
                document.getElementById('errorrecordId').innerHTML="";
                document.getElementById('errorpartId').innerHTML="";
                return false;
            }
            else if (d == "") {
                document.getElementById('erroreventname').innerHTML="Please Enter Event Name.";
                document.getElementById('errorrecordId').innerHTML="";
                document.getElementById('errorpartId').innerHTML="";
                document.getElementById('erroreventId').innerHTML="";
                return false;
            }
            else if (e == "") {
                document.getElementById('errorticketId').innerHTML="Please Enter Ticket ID.";
                document.getElementById('errorrecordId').innerHTML="";
                document.getElementById('errorpartId').innerHTML="";
                document.getElementById('erroreventId').innerHTML="";
                document.getElementById('erroreventname').innerHTML="";
                return false;
            }
            else if (f == "") {
                document.getElementById('errorticketQty').innerHTML="Please Enter Ticket Quantity";
                document.getElementById('errorrecordId').innerHTML="";
                document.getElementById('errorpartId').innerHTML="";
                document.getElementById('erroreventId').innerHTML="";
                document.getElementById('erroreventname').innerHTML="";
                document.getElementById('errorticketId').innerHTML="";
                return false;
            }
            else if (g == "") {
                document.getElementById('errorticketPrice').innerHTML="Please Enter Ticket Price";
                document.getElementById('errorrecordId').innerHTML="";
                document.getElementById('errorpartId').innerHTML="";
                document.getElementById('erroreventId').innerHTML="";
                document.getElementById('erroreventname').innerHTML="";
                document.getElementById('errorticketId').innerHTML="";
                document.getElementById('errorticketQty').innerHTML="";
                return false;
            }
             else if (h == "") {
                document.getElementById('erroreventDesc').innerHTML="Please Enter Event Description";
                document.getElementById('errorrecordId').innerHTML="";
                document.getElementById('errorpartId').innerHTML="";
                document.getElementById('erroreventId').innerHTML="";
                document.getElementById('erroreventname').innerHTML="";
                document.getElementById('errorticketId').innerHTML="";
                document.getElementById('errorticketQty').innerHTML="";
                document.getElementById('errorticketPrice').innerHTML="";
                return false;
            }
       }   
    
        //Reset the data
        function resetForm() {
            document.getElementById("recordId").value = '';
            document.getElementById("partId").value = '';
            document.getElementById("eventId").value = '';
            document.getElementById("eventname").value = '';
            document.getElementById("ticketId").value = '';
            document.getElementById("ticketQty").value = '';
            document.getElementById("ticketPrice").value = '';
            document.getElementById("eventDesc").value = '';
            selectedRow = null;
        }
        
       
</script>

   <head>
        <meta charset="UTF-8">
        <title>View And Manage</title>
        <link href ="view and manage design.css" rel="stylesheet" type="text/css">
        <link href ="view and manage.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
         <header>
            
              <!----------------------logout------------------------->
            <div class="header">
                <div style="padding-left:75em;">
                    <img src="../images/logout.png" class="logout">
                    <a href="../home page/home page.php" style="font-size:1.4em;">LOGOUT</a>
                </div>
        
                
              <!----------------------logo------------------------->
                <div>   
                    <img src="../images/music society logo.jpg" class="logo"> 
                    
                    <div style="font-size:2em;">
                    <div style="padding-top:0.3em;margin-left:6.3em;">MUSIC</div> 
                    <div>SOCIETY</div>   
                    </div>
                </div>

              <br>
               <!----------------------navigation------------------------->
                <div>
                    <nav class="horizontal">
                            <ul class="nav">
                                <br>
                                <li><a href="../home page/home page.php" style="padding-bottom:3px;">Home</a></li>
                                <li><a href="../event/event.php">Events</a></li> 
                                <li><a href="../admin-page/admin-page.php">Admin Page</a></li>  
                            </ul>
                         </nav>
                       </div>
                    </nav>   
                </div>    
            </header>
        
        
        
   
   
        <!----------------------main body(view and manage)------------------------->
        <h1 style="background-image:url(../images/Background.png);height:70px; font-weight:bold; font-size: 3em; color:white; 
            text-align: center; padding-top:0.2em;text-shadow: 1px 1px #36ADA9;opacity: 0.85;">View and Manage</h1>
       
      
       <table>
        <tr>
            <td>
                <form action="processvam.php" method="post" autocomplete="off" onsubmit="onFormSubmit()" name="myForm">
                    <div>
                        <label for="recordId"><b>Record Id:</b></label>
                        <br>
                        <input type="text" name="recordId" id="recordId" required pattern=".{2,}"> 
                        <div id="errorrecordId"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="partId"><b>Participant Id:</b></label>
                        <br>
                        <input type="text" name="partId" id="partId" required pattern=".{3,}"> 
                        <div id="errorpartId"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="eventId"><b>Event Id:</b></label>
                        <br>
                        <input type="text" name="eventId" id="eventId" required pattern=".{5,}">
                        <div id="erroreventId"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="eventname"><b>Event Name:</b></label>
                        <br>
                        <input type="text" name="eventname" id="eventname" required>
                        <div id="erroreventname"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="ticketId"><b>Ticket ID:</b></label>
                        <br>
                        <input type="text" name="ticketId" id="ticketId" required pattern=".{4,}"> 
                        <div id="errorticketId"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="ticketQty"><b>Ticket Quantity:</b></label>
                        <br>
                        <input type="number" name="ticketQty" id="ticketQty" required pattern=".{1,}">
                        <div id="errorticketQty"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="ticketPrice"><b>Ticket Price:</b></label>
                        <br>
                        <input type="number" name="ticketPrice" id="ticketPrice" required>
                        <div id="errorticketPrice"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div>
                        <label for="eventDesc"><b>Event's Description:</b></label>
                        <br>
                        <input type="text" name="eventDesc" id="eventDesc">
                        <div id="erroreventDesc"></div>
                        <br>
                        <br>
                    </div>
                    
                    <div class="form_action--button">
                        <input type="submit" value="Confirm" id="confirm" onclick="myFunction();">
                        <input type="reset" value="Reset" id="reset">
                    </div>
                </form>
                
                
                
                <td>
                    <table class="list" id="bookList">
                        <thead>
                            <tr>
                                <th>Record Id</th>
                                <th>Participant Id</th>
                                <th>Event Id</th>
                                <th>Event Name</th>
                                <th>Ticket Id</th>
                                <th>Ticket Quantity</th>
                                <th>Ticket Price</th>
                                <th>Event's Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            if(isset ($_POST['submit'])){
						
                                $recordID=$_POST['recordID'];
                                $result=mysqli_query($connect, 
                                        "SELECT *FROM record
                                        WHERE recordID='$recordID' ORDER BY recordID ");

                                $row=mysqli_fetch_array($result);

                                if(mysqli_num_rows($result)==0){
                                    //partID not exist in database
                                    $recordID='';
                                    echo"<tr><td colspan=6><p align='center'> No Record Found</p></td></tr>";
                                }
                                else{
                            ?>

                            <?php
                                }

                                }else{	
                                    $data1=mysqli_query($connect,"SELECT *FROM record
                                         ORDER BY recordID");
                                    $no=1;
                                    //print out data from database
                                    while($info1=mysqli_fetch_array($data1)){

                            ?>
                                 <tr class="list" id="bookList">
                                     <td><?php echo $info1['recordID'];?></td>
                                    <td><?php echo $info1['partID'];?></td>
                                    <td><?php echo $info1['eventID'];?></td>
                                    <td><?php echo $info1['eventName'];?></td>
                                    <td><?php echo $info1['ticketID'];?></td>
                                    <td><?php echo $info1['ticketQTY'];?></td>
                                    <td><?php echo $info1['ticketPrice'];?></td>
                                    <td><?php echo $info1['eventDesc'];?></td>

                                        <td>
                                            <div class="form_action--button">
                                                <button onkeypress="onEdit(this)" action="">Edit</button> 
                                                
                                                <button onClick="onDelete(this)">Remove</button>
                                            </div>
                                        </td>
                                    
                                    <!--count-->
                            <?php
                                        $no++;
                                    }
                                }
                            ?>
                    </tr> 
                        </tbody>
                    </table>
                </td>
                
            </td>
        </tr>
    </table>
   
                    
                    
    <br><br><br><br>
    
    <!----------------------footer------------------------->
    <footer>
        <div class="footer">
           <div class="events">
           </div>
        
            <div class="talk">
            </div>
              
            <div class="lessons">
            </div>
            
            <div class="followus">      
            </div>
        </div>
    </footer>
    </body>
</html>