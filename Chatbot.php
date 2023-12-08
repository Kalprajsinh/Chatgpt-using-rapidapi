
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .chat-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .chat-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .chat-box-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .chat-box-body {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
        }

        .message {
            margin-bottom: 10px;
        }

        .user-message {
            background-color: #e6e6e6;
            border-radius: 5px;
            padding: 8px;
        }

        .bot-message {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 8px;
        }

        .input-group {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-box">
        <div class="chat-box-header">Chatbot</div>
        <div class="chat-box-body" id="chat-box-body">
            

        <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user's message
    echo "<hr>";
    $userMessage = $_POST['message'];
    echo $userMessage;
    echo "<hr>";
    
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://chatgpt-gpt4-ai-chatbot.p.rapidapi.com/ask",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'query' => $userMessage
        ]),
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: chatgpt-gpt4-ai-chatbot.p.rapidapi.com",
            "X-RapidAPI-Key: 6129d442d1mshc5b312e0de8c457p183411jsn6a0870a6274a",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }

    // Decode JSON response
    $data = json_decode($response, true);

    echo $data['response'];
  }
?>
        </div>
    </div>

    <div class="input-group">
        <form action="#" method="post">
            <input type="text" class="form-control" name="message" placeholder="Type your message...">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
