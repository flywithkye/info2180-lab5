"use strict";

document.addEventListener('DOMContentLoaded', () => {
    const rqst = new XMLHttpRequest();
    const trylookupbtn = document.getElementById('lookup');
    let countryfile = "world.php";
    let countryinput;
    let maindiv = document.getElementById('maindiv');
    let resultsdiv = document.getElementById('results');
    let replyarr;
    let temp;
    let count;
    
    console.log(trylookupbtn);    
    console.log(resultsdiv);
    console.log(maindiv);
    
    trylookupbtn.addEventListener('click', function(el){  
        console.log("Test");
        el.preventDefault();

        countryinput = document.getElementById('country').value;  
        
        console.log(countryinput);       

        rqst.onreadystatechange = function (){
            if (rqst.readyState === XMLHttpRequest.DONE){
                if (rqst.status === 200){
                    let reply = rqst.responseText;                     
                    console.log(reply);   

                    if (reply.includes("<ul>")){
                        resultsdiv.innerHTML = "";
                        maindiv.style.removeProperty("height"); 

                        replyarr = reply.split(/\n/);
                        console.log(replyarr); 

                        replyarr.shift(); 
                        replyarr.pop();

                        replyarr.forEach((e, i) => {
                            replyarr[i] = e.trim(); 
                        });
                        console.log(replyarr);  

                        count = replyarr.length;

                        console.log(count);
                        console.log((350 + count) * 8.95);
                        
                        resultsdiv.innerHTML = reply;
                        maindiv.setAttribute("style","height:"+ ((350 + count) * 8.95) + "px");
                            
                        console.log(reply);
                        //alert(reply);
                    } else if (reply.includes("<td>") == false){
                        resultsdiv.innerHTML = "";
                        maindiv.style.removeProperty("height"); 

                        resultsdiv.innerHTML = "Country not found. Please try again.";
                    } else {
                        resultsdiv.innerHTML = "";
                        maindiv.style.removeProperty("height");                      
                        
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
   
});