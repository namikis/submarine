    

    function getFavorite(id){
        
        var mysql = require('mysql');
    var client = mysql.createClient({
        host:'localhost',
        user:'root',
        password:'erariikui-n3110',
        database:'submarine'
    });
        
        client.query('insert into user_favorite',{user_id:3,content_id:4},function(error,reaponse){
            if(error) throw error;

            console.log(response);
        });
    };