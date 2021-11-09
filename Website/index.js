const express = require('express');
const hostname = '130.240.207.20';
const port ='24567';
const mysql = require('mysql');

const app = express();

var con = mysql.createConnection({
    host: 'utbweb.its.ltu.se',
    user: '19990308',
    password: 'bestDBever12',
    database: 'db19990308'
});

con.connect(function(error){
    if(error) throw error;
    console.log('It woooooorks!');
});

app.get('/', (req, res) => {
    res.render('index.ejs');
});

app.listen(hostname, () => {
    console.log('server running at http://${hostname}:${port}/');
});