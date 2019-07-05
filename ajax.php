<?php


/*
        Overview of AJAX
*/

/*
AJAX stands for: 
            Asynchronous JavaScript and XML
            
        AJAX is a tool that uses a:
        
            XMLHttpRequest object to communicate with server-side scripts - scripts could be PHP or any other server-side scripting language. And AJAX returns result in the form of HTML, text files, XML, JSON etc.
            
            i.e. AJAX uses an instantiated object of XMLHttpRequest class, using this object, AJAX can send and recieve information in different formats. 
            These formats include but are not limited to:
            
                        JSON
                        XML
                        HTML
                        text files
                            
        In our case, we're using HTML format, we send receive information from a database and display it in a table created using HTML,
        we use a form created in HTML to send data to the database. 
        
        Using the XMLHttpRequest, AJAX can:
        
            Read data from a web server - after the page has been loaded, 
        
            Update a web server WITHOUT reloading - recall when     we were updating the database, we had to refresh the page everytime to see the result. 
            
            Send data to web-server - IN THE BACKGROUND. 
            
Q: When is AJAX used?
    AJAX is a tool that sends POST and GET requests to the PHP script on the server using the XMLHttpRequest class.
    The PHP script then processes these requests on the server, returns the result to the XMLHttpRequest instantiated object as either as a Text file, HTML file, JSON file, or XML file.
    
    Therefore, its important to know that AJAX doesn't send POST or GET request directly to the database, it sends these request to the PHP script thats running on the server. The PHP script running on the server, processes the AJAX request and returns the result. Hence, AJAX is running on your BROWSER - front-end. 
    

Q: How is AJAX used?
    
    Recalling, AJAX is a tool that uses XMLHttpRequest class to send POST and GET request to the server-side script. The server-side script then processes these request accordingly on the server. 
    
    Therefore, to use AJAX you need to instantiate an object of XMLHttpRequest class. 
    
    In PHP, an object of XMLHttpRequest is instantiated as:
    
    $ajax = new XMLHttpRequest(); 
    
    In Javascript, to create a variable, you need to use 'var':
    
    var ajax = new XMLHttpRequest();
    
    ------X--------------
    
    
    When HTML started, it needed something to allow for pop dialog boxes on the page - i.e. interactive behaviour was in demand. Thats how Javascript came into existence. Javascript framework was written to all interactive behaviour with webpages. 
    
    <script> Java code in here </script>
    
    'Java' itself is used to create NATIVE SOFTWARE APPLICATIONS. 
        Native apps are developed for a specific mobile platform using particular programming languages and technologies. 
            eg: IOS apps are written in Objective-C and Swift 
                Android apps are written in Java or Kotlin
                C++ is used for native Windows and Blackberry apps
                
                
    'Javascript' was made for the web, i.e. Javascript is the web version of Java. 
    
    Therefore, Javascript and Java are not the SAME.
    
    'Java' itself was made for developing applications for a specific mobile platform. For eg: Some Android apps use Java as their framework. 
    
    'JQuery' is the minimal write version of Javascript, in JQuery you write less but you get more done. And AJAX is a property of JQuery. 
    
    
    The ide behind all this is to show the hierachy:
    
    AJAX comes from JQuery, JQuery is the minimized version of Javascript, and Javascript the web-version of Java. 
    
    SO: 
    AJAX is a framwork of JQuery, JQuery is a framework of Javascript, and Javascript is a framework of Java. 
    
    
    Recalling that AJAX is a tool that uses an instantiated object of class XMLHttpRequests to send POST and GET requests to the server--side script.
    
    We now know that AJAX is a framework of JQuery.
    
    AJAX is a class that extendeds from XMLHttpRequests class. Which means, AJAX is a child class of XMLHttpRequest class, hence it has access to all the methods of XMLHttpRequest class and we can define new methods in AJAX - all of this is done by JQuery - JQuery is a minimized framework of Javascript - i.e. only the required bare minimal is included in JQuery for making your HTML pages more interactive. 
    
    
    Looking into a few of the JQuery Ajax class Methods. Namely:
    
        $.ajax({name:value, name:value, name:value,....});

            arguments = name:value, name:value,..... 

            The .ajax() method of  JQuery Ajax class takes a number of arguments in the form shown above. The list of arguments that it takes can be found at w3schools.com under Jquery. 

            we use $.ajax() method to fetch data from a database with the help of php

            We're particularly interested in a few of them:

                url:'' - in this argument name:value, we specify the PHP file that will process the data POSTED through the webbrowser, recalling the we mentioned AJAX is a tool that uses XMLHttpRequest class to send POST and GET request to the php script running on the server, which processes the request accordingly. The url:'' specifies which php file will process the data that is being sent. 

                type:'' - this argument defines how you want the data to be send . - the method, POST or GET? 

                data:'' :  - the values that you want to send with the request for the php file that will process the request 

                succes:''  - to return the results to our HTML element id on the front end. 

    
    
        $.post({url, data, function(data, status, xhr), dataType});
        
            We use the $.post() method to send data to the database with the help of php. 
            
            'url' argument specifies the url to send the request to. 
            'data' argument specifies the data that you wish to send to the server along with the request. 
            'function(arguments)' is the function you wish to execute if the post request is a success. 
            
            More information about the JQuery Ajax methods can be found at www.w3schools.com 
            
            we can create variables to hold our URL and data:
            
            var url = a variable to hold your url
            var data = holding your data using method 'serialize() method' 
            
            The serialize() method collects all your form data, encodes it, and attaches it to the post method, to be sent to the php file that will process it.           
            
?>