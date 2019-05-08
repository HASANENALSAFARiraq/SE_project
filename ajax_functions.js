    function get_request(url , call_back)
    {
        xhr = new XMLHttpRequest();
        xhr.onload=function () {
                            if(this.readyState==4 && this.status==200)
                            {
                                call_back(this);
                            }
                         }

        xhr.open("GET",url,true);  
        xhr.send();
        
    }