const express = require('express');
const app = express();
const mysql = require('mysql');

var con = mysql.createConnection({
    host: '#',
    user: '#',
    password: '#'
});

con.connect(function(error){
    if(error){
        console.log('Connection Failed!');
    }else{
        console.log('Connection Established!');
    }
});

app.get('/', (req, res) => {
    res.render('index.ejs');
});

app.listen('3000');