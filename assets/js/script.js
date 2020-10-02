// Web Socket
var conn = new WebSocket("ws://localhost:8080");
conn.onopen = function (e) {
  //console.log("Connection established!");
};

conn.onmessage = function (e) {
  //console.log(e.data);
  showMessages("other", e.data);
};

//conn.send("Hello World!");
///////////////////////////////////////

var form1 = document.getElementById("form1");
var inp_message = document.getElementById("message");
var inp_name = document.getElementById("name");
var btn_env = document.getElementById("btn1");
var area_content = document.getElementById("content");

btn_env.addEventListener("click", () => {
  if (inp_message.value != "") {
    var msg = {
      name: inp_name.value,
      msg: inp_message.value,
    };

    var msg = JSON.stringify(msg);

    conn.send(msg);

    showMessages("me", msg);

    inp_message.value = "";
  }
});

/*
<div class="me">
        <img src="assets/img/Icon awesome-rocketchat.png" alt="" />
        <div class="text">
          <h5>Rian dos Passos</h5>
          <p>Primeira mensagem ...</p>
        </div>
      </div>
*/

function showMessages(how, data) {
  data = JSON.parse(data);

  if (how == "me") {
    var img_src = "assets/img/Icon awesome-rocketchat.png";
  } else if (how == "other") {
    var img_src = "assets/img/Icon awesome-rocketchat-1.png";
  }

  var div = document.createElement("div");
  div.setAttribute("class", how);

  var img = document.createElement("img");
  img.setAttribute("src", img_src);

  var div_txt = document.createElement("div");
  div_txt.setAttribute("class", "text");

  var h5 = document.createElement("h5");
  h5.textContent = data.name;

  var p = document.createElement("p");
  p.textContent = data.msg;

  div_txt.appendChild(h5);
  div_txt.appendChild(p);

  div.appendChild(img);
  div.appendChild(div_txt);

  area_content.appendChild(div);
}
