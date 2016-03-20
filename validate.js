     function checkemail(emailstr){
             var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
             if (filter.test(emailstr)) {
               return true;
             } else {
               return false;
             }
           }

           function ValidateForm() {
               
               
               if (document.getElementById("fname").value.length<3){
                  document.getElementById("fname").focus();
                   document.getElementById("fname").style.backgroundColor="yellow";
                   alert("Please enter a First Name.");
                   return false;
               }
               else if (document.getElementById("lname").value.length<3){
                   document.getElementById("lname").focus();
                   document.getElementById("lname").style.backgroundColor="yellow";
                   alert("Please enter a Last Name.");
                   return false;
               }
               else if (document.getElementById("ksuid").value.length<3){
                    document.getElementById("ksuid").focus();
                  document.getElementById("ksuid").style.backgroundColor="yellow";
                   alert("Please enter a KSU ID.");
                   return false;
                   
               }
               else if (document.getElementById("availability").value.length<3){
                   document.getElementById("availability").focus();
                  document.getElementById("availability").style.backgroundColor="yellow";
                   alert("Please enter your availability.");
                   return false;
                   
               
              
               }else{
                   return true;
               }
           }
               
             
