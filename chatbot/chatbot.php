<div class="chatbot-container" id="chatbot">

    <div class="chat-header">

        AI Assistant

        <span style="cursor:pointer;"
              onclick="toggleChatbot()">

            ✖

        </span>

    </div>

    <div class="chat-body" id="chatBody">

        <div class="bot-message">

            Hello 👋<br>
            Welcome to AI-Solutions.<br><br>

            Ask me about:
            <br>• Services
            <br>• Projects
            <br>• Blog
            <br>• Events
            <br>• Testimonials
            <br>• Contact

        </div>

    </div>

    <div class="chat-footer">

        <input type="text"
               id="userInput"
               placeholder="Type your question...">

        <button onclick="sendMessage()">

            Send

        </button>

    </div>

</div>

<script>

function toggleChatbot(){

    document.getElementById("chatbot")
    .style.display = "none";

}

function sendMessage(){

    let input =
    document.getElementById("userInput");

    let message =
    input.value.trim();

    if(message===""){

        return;

    }

    let chatBody =
    document.getElementById("chatBody");

    chatBody.innerHTML +=
    `
    <div class="user-message">
        ${message}
    </div>
    `;

    let response =
    getBotResponse(message.toLowerCase());

    setTimeout(()=>{

        chatBody.innerHTML +=
        `
        <div class="bot-message">
            ${response}
        </div>
        `;

        chatBody.scrollTop =
        chatBody.scrollHeight;

    },500);

    input.value = "";

}

function getBotResponse(message){

    /*
    HOME
    */

    if(
        message.includes("home")
    ){

        return `
        AI-Solutions provides AI-powered
        software solutions, web development,
        automation systems, and intelligent
        chatbot technologies.
        `;
    }

    /*
    ABOUT
    */

    if(
        message.includes("about")
        ||
        message.includes("company")
    ){

        return `
        AI-Solutions is a software company
        focused on AI solutions, modern
        web applications, automation
        systems, and digital transformation.
        `;
    }

    /*
    SERVICES
    */

    if(
        message.includes("service")
        ||
        message.includes("services")
    ){

        return `
        Our services include:
        <br><br>
        • AI Chatbot Development
        <br>
        • Web Development
        <br>
        • Business Automation
        <br>
        • AI Integration
        <br>
        • Software Solutions
        `;
    }

    /*
    PROJECTS
    */

    if(
        message.includes("project")
        ||
        message.includes("projects")
    ){

        return `
        We have completed various
        AI chatbot systems,
        automation platforms,
        and modern business websites.
        Visit the Projects page
        for detailed information.
        `;
    }

    /*
    BLOG
    */

    if(
        message.includes("blog")
        ||
        message.includes("article")
    ){

        return `
        Our Blog section contains
        articles related to AI,
        automation, software development,
        and emerging technologies.
        `;
    }

    /*
    GALLERY
    */

    if(
        message.includes("gallery")
        ||
        message.includes("photos")
        ||
        message.includes("images")
    ){

        return `
        Our Gallery contains
        company activities,
        promotional events,
        and project showcases.
        `;
    }

    /*
    EVENTS
    */

    if(
        message.includes("event")
        ||
        message.includes("events")
    ){

        return `
        Upcoming events and
        company activities are
        available in our Events page.
        `;
    }

    /*
    TESTIMONIALS
    */

    if(
        message.includes("testimonial")
        ||
        message.includes("review")
        ||
        message.includes("rating")
    ){

        return `
        Customer testimonials
        showcase feedback and ratings
        received from our clients.
        `;
    }

    /*
    FEEDBACK
    */

    if(
        message.includes("feedback")
    ){

        return `
        You can submit feedback
        through our Feedback page.
        We value customer opinions
        and suggestions.
        `;
    }

    /*
    CONTACT
    */

    if(
        message.includes("contact")
        ||
        message.includes("phone")
        ||
        message.includes("email")
    ){

        return `
        Contact Information:
        <br><br>

        📧 info@aisolutions.com
        <br>

        📞 +977 9800000000
        <br>

        📍 Kathmandu, Nepal
        `;
    }

    /*
    JOB REQUEST
    */

    if(
        message.includes("job")
        ||
        message.includes("hire")
        ||
        message.includes("requirement")
    ){

        return `
        To discuss your project
        requirements, please visit
        the Contact page and submit
        your job details. Our team
        will contact you shortly.
        `;
    }

    /*
    PRICE
    */

    if(
        message.includes("price")
        ||
        message.includes("cost")
        ||
        message.includes("quotation")
    ){

        return `
        Project pricing depends on
        your specific requirements.
        Please submit your details
        through the Contact page
        to receive a quotation.
        `;
    }

    /*
    DEFAULT
    */

    return `
    Sorry, I couldn't understand
    your question.<br><br>

    Try asking about:
    <br>
    • Services
    <br>
    • Projects
    <br>
    • Blog
    <br>
    • Gallery
    <br>
    • Events
    <br>
    • Testimonials
    <br>
    • Feedback
    <br>
    • Contact
    `;

}

document
.getElementById("userInput")
.addEventListener("keypress",

function(event){

    if(event.key==="Enter"){

        sendMessage();

    }

});

</script>