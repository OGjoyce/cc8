const http = require('http');
var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";
const host = '192.168.0.122';
const port = 8644;  
var request = '';
const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE'); // If needed
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type'); // If needed
    res.setHeader('Access-Control-Allow-Credentials', true); // If needed
    res.setHeader('Content-Type', 'text/plain');
    var now = new Date();
    var jsonDate = now.toJSON();
    requestState ='';
    req.on('data', function(data) {
      console.log('REQUEST.... ; '+ data.toString());
      requestState = data.toString();
        // MongoClient.connect(url, function(err, db){
        //     if(err) throw err;  
        //     var dbo = db.db("admin");
        //     var myobj = {req: `${data}`};
        //     dbo.collection("Datos").insertOne(myobj, function(err, res) {
        //       if (err) throw err;
        //       console.log("requestssss");
        //       db.close();
        //     });
        //   });
      })
  
    if(req.url.match('/info/')){
        var responseClient = `{"​id​":"BloodWolf","​url​":${host},"​date​":${jsonDate},"​hardware​":{"​BloodWolf​":{"​tag​":"PWM","​type​":"input"}}}`;
        res.end(responseClient);
        MongoClient.connect(url, function(err, db){
          if(err) throw err;  
          var dbo = db.db("admin");
          var myobj = {response: `${responseClient}`, req: requestState};
          dbo.collection("Datos").insertOne(myobj, function(err, res) {
            if (err) throw err;
            console.log("info response inseerted");
            db.close();
          });
        });
        
    }
    if(req.url.match('/search/')){
      console.log(request);
          var responseClient = `{"​id​":"BloodWolf","​url​":"${host}","​date​":"${jsonDate}","​search​":{"​id_hardware​":"BloodWolf","​type​":"input"},"​data​":{"2019-12-20T07:35:49.757Z":{"​sensor​":467,"​status​":false,"​freq​":30000,"​text​":"Estable"}}}`;
          res.end(responseClient);
          MongoClient.connect(url, function(err, db){
            if(err) throw err;  
            var dbo = db.db("admin");
            var myobj = {response: `${responseClient}`, req: requestState};
            dbo.collection("Datos").insertOne(myobj, function(err, res) {
              if (err) throw err;
              console.log("search response inserted");
              db.close();
            });
          });
        
    }
    if(req.url.match('/change/')){
          var responseClient = `{"​id​":"BloodWolf","​url​":"${host}","​date​":"${jsonDate}","​status": "ok"}}}`;
          res.end(responseClient);
          MongoClient.connect(url, function(err, db){
            if(err) throw err;  
            var dbo = db.db("admin");
            var myobj = {response: `${responseClient}`, req: requestState};
            dbo.collection("Datos").insertOne(myobj, function(err, res) {
              if (err) throw err;
              console.log("change response inserted");
              db.close();
            });
          });

    }
        
   

  });
  function insertMongo(data){
        
  }
  server.listen(port, host, () => {
    console.log(`Servidor corriendo en http://${host}:${port}`);
    
  });   