"use strict";

document.addEventListener('DOMContentLoaded', () => {
    const rqst = new XMLHttpRequest();
    const lookupbtn = document.getElementById('lookup');
    const lookupctybtn = document.getElementById('lookupcity');
    let countryfile = "world.php";
    let countryinput;
    let maindiv = document.getElementById('maindiv');
    let resultsdiv = document.getElementById('results');
    
    console.log(lookupbtn);    
    console.log(lookupctybtn); 
    console.log(resultsdiv);
    console.log(maindiv);
    
    lookupbtn.addEventListener('click', function(el){  
        el.preventDefault();

        countryinput = document.getElementById('country').value;  
        
        console.log(countryinput);       

        rqst.onreadystatechange = function (){
            if (rqst.readyState === XMLHttpRequest.DONE){
                if (rqst.status === 200){
                    let reply = rqst.responseText;                     
                    console.log(reply);   

                    if (reply.includes("All Countries")){
                        resultsdiv.innerHTML = "";
                        
                        reply = reply.replaceAll('All Countries', '');
                        console.log(reply);  

                        resultsdiv.innerHTML = reply;
                            
                        console.log(reply);
                        //alert(reply);

                    } else if (reply.includes("<td>") == false){
                        resultsdiv.innerHTML = "";

                        resultsdiv.innerHTML = "Country not found. Please try again.";
                    
                    } else {
                        resultsdiv.innerHTML = "";                     
                        
                        resultsdiv.innerHTML = reply;
                        
                        //alert(reply);
                    }
                    
                                    
                } else {
                    alert('There was a problem with the request.')
                }
            }
        };
        
        rqst.open('GET', countryfile+"?country="+countryinput);
        rqst.send();
    });

    lookupctybtn.addEventListener('click', function(el){  
        el.preventDefault();

        countryinput = document.getElementById('country').value;  
        
        console.log(countryinput);       

        rqst.onreadystatechange = function (){
            if (rqst.readyState === XMLHttpRequest.DONE){
                if (rqst.status === 200){
                    let reply = rqst.responseText;                     
                    console.log(reply);   

                    if (reply.includes("All Countries")){
                        resultsdiv.innerHTML = "";
                        
                        reply = reply.replaceAll('All Countries', '');
                        console.log(reply);  

                        resultsdiv.innerHTML = reply;
                            
                        console.log(reply);
                        //alert(reply);

                    } else if (reply.includes("<td>") == false){
                        resultsdiv.innerHTML = "";

                        resultsdiv.innerHTML = "Please type the full name of a Country to search for Cities. 'Lookup' can provide assistance.";
                    
                    } else {
                        resultsdiv.innerHTML = "";                     
                        
                        resultsdiv.innerHTML = reply;
                    }
                    
                                    
                } else {
                    alert('There was a problem with the request.')
                }
            }
        };
        
        rqst.open('GET', countryfile+"?country="+countryinput+"&lookup=cities");
        rqst.send();
    });
   
});