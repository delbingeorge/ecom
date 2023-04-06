<?php
               
               $status = true;
               $invoice = "bla";
               $sql = "INSERT INTO payments (Amount,Payment_Status,Bill_Invoice) VALUES ('$amount','$status','$invoice')";
               if (mysqli_query($conn, $sql)) {
                    echo 'asd';
               } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
               }
               ?>