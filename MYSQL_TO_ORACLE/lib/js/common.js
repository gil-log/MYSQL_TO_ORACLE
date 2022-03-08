function callAjax(url, method, data, callback){
    var xhr = new XMLHttpRequest();

    var response = '';

    xhr.onload = function() {
        if( xhr.status === 200 || xhr.status === 201 ){
            callback(xhr.responseText);
        } else {
            console.log(xhr.responseText);
        }
    };

    xhr.open(method, url);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(data));

}