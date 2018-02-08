<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Html</title>
    <style>
        .chat-place {
            display: block;
            width: 700px;
            height: 1000px;
            overflow: scroll;
            background: #ccc;
            margin: 0 auto;
            padding: 20px;
        }

        .chat-place .info {
            margin: 0 auto;
            width: 250px;
            text-align: center;
        }

        #messages-field .leftmessage {

        }

        .info input {
            padding: 10px;
        }

        .row label {
            display: block;
        }

        .info input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<div class="chat-place">
    <div class="info">
        <h1>Web Sockets!</h1>

        <form action="" name="messages">
            <div class="row">
                <label>Name: </label>
                <input type="text" id="nameField" autocompvare="off" name="fname"/>
            </div>
            <div class="row">
                <label>Text: </label>
                <input type="text" id="textField" autocompvare="off" name="msg"/>
            </div>
            <div class="row"><input type="submit" value="go!"/></div>
        </form>
        <div id="status"></div>
    </div>

    <div id="messages-field">
        <div class="leftmessage">
            <!--<h3>Ivan: <span>Hello!</span></h3>-->

        </div>
    </div>
</div>
<script>
    window.onload = function () {
        var socket = new WebSocket('ws://grant.dev:8080');
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
        socket.onmessage = function (event) {

            var mess = JSON.parse(event.data);

        };
        socket.onerror = function (event) {
            console.log(event.message);
        };
        document.forms['messages'].onsubmit = function () {
            var message = {
                name: this.fname.value,
                msg: this.msg.value
            }
            socket.send(JSON.stringify(message));
            return false;
        }
    };
</script>
</body>
</html>