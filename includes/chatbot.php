<?php

header("Content-Type: application/json");

$message = trim($_POST['message'] ?? '');

if(empty($message)){

    echo json_encode([
        "reply" => "Please enter a message."
    ]);

    exit();
}

/*
|--------------------------------------------------------------------------
| GEMINI API KEY
|--------------------------------------------------------------------------
*/

$apiKey = "";

/*
|--------------------------------------------------------------------------
| AI-Solutions Context
|--------------------------------------------------------------------------
*/

$prompt = "

You are the official AI-Solutions Virtual Assistant.

Company Name:
AI-Solutions

Location:
Kathmandu, Nepal

Email:
info@aisolutions.com

Services:
- AI Chatbot Development
- Website Development
- Mobile App Development
- Software Development
- Business Automation
- AI Integration
- Machine Learning Solutions

Website Pages:
- Home
- About
- Services
- Projects
- Blog
- Gallery
- Events
- Testimonials
- Feedback
- Contact

Rules:

1. Be professional and friendly.
2. If user greets you, greet them warmly.
3. If user asks about services, explain company services.
4. If user asks about pricing, say pricing depends on project requirements.
5. If user wants a website, software, chatbot, app, or automation system, tell them to submit their requirements through the Contact page.
6. Keep answers concise.
7. If information is unavailable, suggest contacting AI-Solutions.

User Question:
".$message;

/*
|--------------------------------------------------------------------------
| Gemini API Endpoint
|--------------------------------------------------------------------------
*/

$url =
"https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=".$apiKey;

$data = [

    "contents" => [

        [

            "parts" => [

                [
                    "text" => $prompt
                ]

            ]

        ]

    ]

];

/*
|--------------------------------------------------------------------------
| CURL Request
|--------------------------------------------------------------------------
*/

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    [
        "Content-Type: application/json"
    ]
);

curl_setopt(
    $ch,
    CURLOPT_POSTFIELDS,
    json_encode($data)
);

$result = curl_exec($ch);

/*
|--------------------------------------------------------------------------
| CURL Error
|--------------------------------------------------------------------------
*/

if(curl_errno($ch)){

    echo json_encode([
        "reply" =>
        "Connection Error: ".curl_error($ch)
    ]);

    curl_close($ch);

    exit();
}

curl_close($ch);

/*
|--------------------------------------------------------------------------
| Decode Response
|--------------------------------------------------------------------------
*/

$response = json_decode($result, true);

/*
|--------------------------------------------------------------------------
| API Error
|--------------------------------------------------------------------------
*/

if(isset($response['error'])){

$msg = strtolower(trim($message));

if(
    strpos($msg,'hi') !== false ||
    strpos($msg,'hello') !== false ||
    strpos($msg,'hey') !== false
){
    $reply = "Hello 👋 Welcome to AI-Solutions. I'm your virtual assistant. I can help you learn about our company, services, projects, blogs, events, testimonials, contact details, and more.";
}

elseif(
    strpos($msg,'about') !== false ||
    strpos($msg,'company') !== false
){
    $reply = "AI-Solutions is a software development company based in Kathmandu, Nepal. We specialise in AI-powered software, web development, mobile applications, business automation, chatbots, and machine learning solutions.";
}

elseif(
    strpos($msg,'service') !== false
){
    $reply = "Our services include AI Chatbot Development, Website Development, Software Development, Mobile App Development, Business Automation, AI Integration, Database Development, and Machine Learning Solutions.";
}

elseif(
    strpos($msg,'project') !== false
){
    $reply = "Our Projects page showcases completed AI systems, web applications, chatbot solutions, business management systems, and custom software developed for clients.";
}

elseif(
    strpos($msg,'blog') !== false
){
    $reply = "Our Blog page shares articles about Artificial Intelligence, Web Development, Software Engineering, Cyber Security, Machine Learning, and emerging technologies.";
}

elseif(
    strpos($msg,'gallery') !== false
){
    $reply = "Our Gallery page displays screenshots of completed projects, development activities, events, and company achievements.";
}

elseif(
    strpos($msg,'event') !== false
){
    $reply = "Our Events page provides information about technology workshops, AI seminars, software training sessions, product launches, and upcoming company events.";
}

elseif(
    strpos($msg,'testimonial') !== false ||
    strpos($msg,'review') !== false
){
    $reply = "The Testimonials page contains feedback and reviews from satisfied clients who have used our AI, software development, and business automation services.";
}

elseif(
    strpos($msg,'feedback') !== false
){
    $reply = "You can share your experience through our Feedback page. Customer feedback helps us continuously improve our products and services.";
}

elseif(
    strpos($msg,'contact') !== false ||
    strpos($msg,'email') !== false ||
    strpos($msg,'phone') !== false
){
    $reply = "You can contact AI-Solutions by visiting the Contact page. Email: info@aisolutions.com | Phone: +977 9800000000 | Location: Kathmandu, Nepal.";
}

elseif(
    strpos($msg,'location') !== false ||
    strpos($msg,'address') !== false
){
    $reply = "AI-Solutions is located in Kathmandu, Nepal. We provide software development services for clients locally and internationally.";
}

elseif(
    strpos($msg,'price') !== false ||
    strpos($msg,'cost') !== false ||
    strpos($msg,'quotation') !== false
){
    $reply = "Project pricing depends on the project scope, features, technology, and timeline. Please submit your requirements through the Contact page for a customised quotation.";
}

elseif(
    strpos($msg,'website') !== false
){
    $reply = "Yes, we design and develop responsive websites using modern technologies such as PHP, Bootstrap, JavaScript, MySQL/PostgreSQL, and AI integration.";
}

elseif(
    strpos($msg,'chatbot') !== false
){
    $reply = "We develop AI-powered chatbots that provide automated customer support, answer frequently asked questions, and integrate with websites and business systems.";
}

elseif(
    strpos($msg,'mobile app') !== false ||
    strpos($msg,'android') !== false ||
    strpos($msg,'ios') !== false
){
    $reply = "We develop secure and user-friendly mobile applications for Android and iOS platforms based on client requirements.";
}

elseif(
    strpos($msg,'software') !== false
){
    $reply = "We develop custom software solutions including management systems, inventory systems, booking systems, business automation software, and AI-powered applications.";
}

elseif(
    strpos($msg,'automation') !== false
){
    $reply = "Business automation solutions help organisations improve efficiency by automating repetitive tasks, workflows, reporting, and customer services.";
}

elseif(
    strpos($msg,'ai') !== false ||
    strpos($msg,'artificial intelligence') !== false
){
    $reply = "Artificial Intelligence enables computer systems to perform tasks that normally require human intelligence. AI-Solutions integrates AI into websites, software, automation systems, and chatbots.";
}

elseif(
    strpos($msg,'thank') !== false
){
    $reply = "You're welcome! 😊 If you have any other questions about AI-Solutions or our services, feel free to ask.";
}

elseif(
    strpos($msg,'bye') !== false ||
    strpos($msg,'goodbye') !== false
){
    $reply = "Thank you for visiting AI-Solutions. Have a wonderful day! 👋";
}

else{

    $reply = "Thank you for your question. I can help you with information about AI-Solutions, our services, projects, blogs, gallery, events, testimonials, feedback, contact details, pricing, websites, software development, chatbots, AI, and business automation. For project-specific enquiries, please use the Contact page.";

}

echo json_encode([
    "reply"=>$reply
]);

exit();

}


/*
|--------------------------------------------------------------------------
| Extract Reply
|--------------------------------------------------------------------------
*/

$reply =
$response['candidates'][0]['content']['parts'][0]['text']
?? "Sorry, I couldn't answer your question at the moment.";

/*
|--------------------------------------------------------------------------
| Return JSON
|--------------------------------------------------------------------------
*/

echo json_encode([
    "reply" => $reply
]);

?>
