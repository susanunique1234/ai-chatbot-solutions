
console.log("Chatbot JS Loaded");
function toggleChatbot(){


let chatbot =
document.getElementById("chatbot");

if(!chatbot){

    console.log("Chatbot not found");

    return;
}

if(
    chatbot.style.display === "none" ||
    chatbot.style.display === ""
){

    chatbot.style.display = "block";

}else{

    chatbot.style.display = "none";

}


}

function sendMessage(){

let input =
document.getElementById("userInput");

let message =
input.value.trim();

if(message === ""){

    return;
}

let chatBody =
document.getElementById("chatBody");

chatBody.innerHTML += `
<div class="user-message">
${message}
</div>
`;

input.value = "";

fetch("/ai-chatbot-solutions/includes/chatbot.php",{

    method:"POST",

    headers:{
        "Content-Type":
        "application/x-www-form-urlencoded"
    },

    body:
    "message=" +
    encodeURIComponent(message)

})

.then(response => response.json())

.then(data => {

    chatBody.innerHTML += `
    <div class="bot-message">
    ${data.reply}
    </div>
    `;

    chatBody.scrollTop =
    chatBody.scrollHeight;

})

.catch(error => {

    console.log("ERROR:", error);

    chatBody.innerHTML +=
    `<div class="bot-message">
        Error: ${error}
    </div>`;

});


}

document.addEventListener(
"DOMContentLoaded",
function(){

let input =
document.getElementById("userInput");

if(input){

    input.addEventListener(
    "keypress",

    function(event){

        if(event.key === "Enter"){

            sendMessage();

        }

    });

}

});
