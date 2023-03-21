<!DOCTYPE html>
<html>
    <head>
        <style> 
            #menuitem1{    
                 
                top: 100px;  
                height: 30 px; 
                padding-bottom : 50px;   
                position: absolute;         
            }
            #menu1{    
                position: absolute;    
                top : 200 px;  
                left: 100 px;    
                z-index: 2;    
            } 
            .menuOff{    
                display: none;    
            }    

            .menuOn{    
                display: block;    
            }  
        </style>
    </head>
    <body> 
        <button id = "menuitem1" onclick = "buttonclick1();"> dashboard </button> <br>
        <div>
            <ul id = "menu1" class = "menuOff">
                <li> <a href = "dashboard.php"> Dashboard </a> </li>
            </ul>   
        </div>
        <script> 
            function buttonclick1(){    
                var menuList = document.getElementById("menu1");    
                if (menuList.className == "menuOn"){    
                    menuList.className = "menuOff";    
                } else{    
                    menuList.className = "menuOn";    
                }    
            }  
        </script>
    </body>
</html>
