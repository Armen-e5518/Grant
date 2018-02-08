
window.onload = function () {

    socket = new WebSocket('ws://grant.dev:8080');

    socket_flag = true;

    socket.onopen = function (event) {
        console.log('connected')
    };
    socket.onclose = function (event) {
        if (event.wasClean) {
            console.log('closed')
        } else {
            console.log('closed some')
        }
    };

    socket.onerror = function (event) {
        console.log(event.message);
    };

};

