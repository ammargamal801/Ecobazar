<?php
// Initialize variables
$fullName = $email = $message = $replyMessage = "";
$fullNameErr = $emailErr = $messageErr = $replyMessageErr = "";
$submitSuccess = false;
$deleteSuccess = false;
$replySuccess = false;

// Process form submission


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if delete comment request
    if (isset($_POST['delete_comment'])) {
        $commentId = $_POST['comment_id'];
        $commentsFile = 'comments.json';

        if (file_exists($commentsFile)) {
            $currentComments = json_decode(file_get_contents($commentsFile), true);

            // Remove the comment with the specified ID
            if (isset($currentComments[$commentId])) {
                array_splice($currentComments, $commentId, 1);
                file_put_contents($commentsFile, json_encode($currentComments, JSON_PRETTY_PRINT));
                $deleteSuccess = true;
            }
        }
    }
    // Check if like action
    elseif (isset($_POST['action']) && $_POST['action'] === 'like') {
        $commentId = $_POST['comment_id'];
        $commentsFile = 'comments.json';

        // Check if already liked via cookie
        $cookie_name = "liked_comment_" . $commentId;
        if (isset($_COOKIE[$cookie_name])) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                $currentComments = json_decode(file_get_contents($commentsFile), true);
                $likes = 0;
                if (isset($currentComments[$commentId]) && isset($currentComments[$commentId]['likes'])) {
                    $likes = $currentComments[$commentId]['likes'];
                }
                echo json_encode(['already_liked' => true, 'likes' => $likes]);
                exit;
            }
            // For non-AJAX, could redirect or show a message, but AJAX is primary here.
            // Consider what to do if not an AJAX request, though current JS uses AJAX.
            return;
        }

        if (file_exists($commentsFile)) {
            $currentComments = json_decode(file_get_contents($commentsFile), true);

            if (isset($currentComments[$commentId])) {
                // Initialize likes if it doesn't exist
                if (!isset($currentComments[$commentId]['likes'])) {
                    $currentComments[$commentId]['likes'] = 0;
                }

                $currentComments[$commentId]['likes']++;

                file_put_contents($commentsFile, json_encode($currentComments, JSON_PRETTY_PRINT));
                // Set cookie after successful like
                setcookie($cookie_name, "true", time() + (86400 * 365), "/"); // Cookie for 1 year

                // Return updated like count for AJAX requests
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                    echo json_encode(['likes' => $currentComments[$commentId]['likes'], 'success' => true]);
                    exit;
                }
            } else {
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                    echo json_encode(['error' => 'Comment not found.']);
                    exit;
                }
            }
        } else {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode(['error' => 'Comments file not found.']);
                exit;
            }
        }
    }
    // Check if reply action
    elseif (isset($_POST['action']) && $_POST['action'] === 'reply') {
        $commentId = $_POST['comment_id'];
        $replyMessage = test_input($_POST['reply_message']);
        $commentsFile = 'comments.json';

        if (empty($replyMessage)) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode(['error' => 'Reply message is required']);
                exit;
            }
        } else {
            if (file_exists($commentsFile)) {
                $currentComments = json_decode(file_get_contents($commentsFile), true);

                if (isset($currentComments[$commentId])) {
                    // Initialize replies array if it doesn't exist
                    if (!isset($currentComments[$commentId]['replies'])) {
                        $currentComments[$commentId]['replies'] = [];
                    }

                    // Create reply data
                    $replyData = [
                        'message' => $replyMessage,
                        'date' => date('d M, Y'),
                        'fullName' => isset($_COOKIE['commentName']) ? $_COOKIE['commentName'] : 'Anonymous',
                    ];

                    // Add reply to comment
                    $currentComments[$commentId]['replies'][] = $replyData;

                    file_put_contents($commentsFile, json_encode($currentComments, JSON_PRETTY_PRINT));
                    $replySuccess = true;

                    // Return success message for AJAX requests
                    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                        echo json_encode([
                            'success' => true,
                            'reply' => $replyData
                        ]);
                        exit;
                    }
                }
            }
        }
    }
    // Regular comment submission
    else {
        // Validate name
        if (empty($_POST["fullName"])) {
            $fullNameErr = "Name is required";
        } else {
            $fullName = test_input($_POST["fullName"]);
            // Check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z\s\p{Arabic}]*$/u", $fullName)) {
                $fullNameErr = "Only letters and white space allowed";
            }
        }

        // Validate email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // Check if email address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate message
        if (empty($_POST["message"])) {
            $messageErr = "Comment is required";
        } else {
            $message = test_input($_POST["message"]);
        }

        // If no errors, save comment to file
        if (empty($fullNameErr) && empty($emailErr) && empty($messageErr)) {
            // Generate avatar color based on email (for consistency)
            $hash = md5($email);
            $colorHex = '#' . substr($hash, 0, 6);

            $commentData = [
                'fullName' => $fullName,
                'email' => $email,
                'message' => $message,
                'date' => date('d M, Y'),
                'colorHex' => $colorHex,
                'initials' => getInitials($fullName),
                'likes' => 0,
                'replies' => []
            ];

            // Save to comments.json file
            $commentsFile = 'comments.json';

            // Create default comments if file doesn't exist
            if (!file_exists($commentsFile)) {
                $defaultComments = getDefaultComments();
                file_put_contents($commentsFile, json_encode($defaultComments, JSON_PRETTY_PRINT));
            }

            // Read existing comments
            $currentComments = json_decode(file_get_contents($commentsFile), true);

            // Add new comment at the beginning of the array
            array_unshift($currentComments, $commentData);

            // Save all comments back to file
            file_put_contents($commentsFile, json_encode($currentComments, JSON_PRETTY_PRINT));

            // Clear form fields after successful submission
            $fullName = $email = $message = "";
            $submitSuccess = true;
        }
    }
}

// Helper function to sanitize input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Helper function to get initials from full name
function getInitials($name)
{
    $words = explode(' ', $name);
    $initials = '';

    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8');
        }
    }

    // If only one initial, use the first two letters
    if (strlen($initials) < 2 && mb_strlen($name, 'UTF-8') > 1) {
        $initials = mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
    }

    return $initials;
}

// Function to load comments
function getComments()
{
    $commentsFile = 'comments.json';
    if (file_exists($commentsFile)) {
        return json_decode(file_get_contents($commentsFile), true);
    }
    // Return default comments if file doesn't exist
    return getDefaultComments();
}

// Function to create default comments with avatar format
function getDefaultComments()
{
    // Define a set of vibrant colors for avatars
    $colors = [
        '#4f46e5', // Indigo
        '#10b981', // Emerald
        '#f59e0b', // Amber
        '#ef4444', // Red
        '#8b5cf6', // Purple
        '#06b6d4', // Cyan
        '#ec4899', // Pink
        '#f97316', // Orange
        '#14b8a6', // Teal
        '#6366f1'  // Indigo
    ];

    return [
        [
            'fullName' => 'Annette Black',
            'email' => 'annette@example.com',
            'message' => 'In a nisi commodo, consequat maximus arcu diam non diam.',
            'date' => '26 Apr, 2021',
            'colorHex' => $colors[0],
            'initials' => 'AB',
            'likes' => rand(0, 15),
            'replies' => []
        ],
        [
            'fullName' => 'Devon Lane',
            'email' => 'devon@example.com',
            'message' => 'Quisque eget tortor lobortis, facilisis metus eu, elementum est. Nunc sit amet erat quis ex convalis suscipi',
            'date' => '24 Apr, 2021',
            'colorHex' => $colors[1],
            'initials' => 'DL',
            'likes' => rand(0, 15),
            'replies' => []
        ],
        [
            'fullName' => 'Jacob Jones',
            'email' => 'jacob@example.com',
            'message' => 'Vestibulum ante ipsrci luctus et ultrices posuere cubilia curae.',
            'date' => '20 Apr, 2021',
            'colorHex' => $colors[2],
            'initials' => 'JJ',
            'likes' => rand(0, 15),
            'replies' => []
        ],
        [
            'fullName' => 'Jane Cooper',
            'email' => 'jane@example.com',
            'message' => 'Pellentesque feugiat, nibh vel vehicula pretium, nibh nibh bibendum elit, a voluptat arcu dui nec',
            'date' => '18 Apr, 2021',
            'colorHex' => $colors[3],
            'initials' => 'JC',
            'likes' => rand(0, 15),
            'replies' => []
        ],
        [
            'fullName' => 'Darrell Steward',
            'email' => 'darrell@example.com',
            'message' => 'Nulla molestie interdum ultrices.',
            'date' => '7 Apr, 2021',
            'colorHex' => $colors[4],
            'initials' => 'DS',
            'likes' => rand(0, 15),
            'replies' => []
        ]
    ];
}

// Generate a unique color for each user based on their email
function getUserColor($email)
{
    $colors = [
        '#4f46e5', // Indigo
        '#10b981', // Emerald
        '#f59e0b', // Amber
        '#ef4444', // Red
        '#8b5cf6', // Purple
        '#06b6d4', // Cyan
        '#ec4899', // Pink
        '#f97316', // Orange
        '#14b8a6', // Teal
        '#6366f1'  // Indigo
    ];

    $hash = md5($email);
    $colorIndex = hexdec(substr($hash, 0, 8)) % count($colors);

    return $colors[$colorIndex];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../Style/main.css">
    <link rel="stylesheet" href="comments.css">
    <title>Shopery - Organic eCommerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        @media screen and (max-width: 480px) {
            .summer-sales-banner h2 {
                font-size: 1.5rem;
            }

            .summer-sales-banner .discount {
                font-size: 1.2rem;
            }

            .user-avatar {
                width: 40px !important;
                height: 40px !important;
            }
        }

        /* Base Styles */
        :root {
            --background-page: #ffffff;
            --background-card: #f0f8ff;
            --footer-background: #333333;
            --white-text-color: #808080;
            --black-text-color: #002603;
            --sticker-color: #00b207;
            --text-hover-color: #2c742f;
            --card-border-color: #e6e6e6;
            --header-text-not-hovered: #999999;
            --green-text: #00b207;
            --footer-background: #1a1a1a;
            --second-background: #edf2ee;
            --discount-background: #ea4b481a;
            --discount: #ea4b48;
            /* //////////////////////////////////////////// */
            --primary-color: #4caf50;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #666666;
            --border-color: #e0e0e0;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --star-color: #ffc107;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        .custom-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .green-btn {
            background-color: var(--sticker-color);
            transition: background-color 0.3s ease;
            border-radius: 43px;
        }

        .green-btn:hover {
            background-color: var(--text-hover-color);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }


        ::-webkit-scrollbar-thumb {
            background: #22c55e;
            border-radius: 43px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #16a34a;
        }

        /* Error message styling */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Success message styling */
        .success-message {
            background-color: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        /* Avatar styling */
        .user-avatar {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            border-radius: 50%;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 10;
            display: none;
            min-width: 120px;
            padding: 0.5rem 0;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            text-align: left;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
        }

        /* Like button active state */
        .like-btn.active {
            color: #00b207;
        }

        .like-btn.active i {
            font-weight: 900;
            /* Solid icon when active */
        }

        /* Reply section */
        .reply-section {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            display: none;
        }

        /* Reply list */
        .replies-list {
            margin-top: 1rem;
            padding-left: 2rem;
            border-left: 2px solid #e5e7eb;
        }

        .reply-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px dashed #e5e7eb;
        }

        .reply-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body class="bg-white">
    <?php
    include '../header.php';
    ?>
    <div class="container mx-auto px-4 py-8 max-w-[1200px]">
        <!-- Summer Sales Banner -->
        <div
            class="bg-black text-white flex items-center justify-between rounded-2xl overflow-hidden custom-shadow mb-8">
            <div class="p-6 md:p-10 w-full md:w-1/2 relative">
                <p class="text-sm uppercase tracking-wider mb-2 text-gray-300">Summer Sales</p>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Fresh Fruit</h2>

                <a href="#"
                    class="inline-block green-btn text-white font-semibold px-10 py-3 rounded-4xl mt-4 hover:bg-green-700 transition-colors">
                    Shop Now →
                </a>
            </div>
            <div class="hidden md:block w-1/2 w-full">
                <img src="image/008cb8180e611fb0a5864215abcdebb5.png" alt="Fresh Fruits"
                    class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Leave a Comment Section -->
        <div class="p-6 md:p-10 mb-5 bg-white rounded-lg shadow-sm">
            <h1 class="text-3xl font-bold mb-6">Leave a Comment</h1>

            <?php if ($submitSuccess): ?>
                <div class="success-message mb-6">
                    <p>Your comment has been posted successfully!</p>
                </div>
            <?php endif; ?>

            <?php if ($deleteSuccess): ?>
                <div class="success-message mb-6">
                    <p>Comment has been deleted successfully!</p>
                </div>
            <?php endif; ?>

            <?php if ($replySuccess): ?>
                <div class="success-message mb-6">
                    <p>Your reply has been posted successfully!</p>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="fullName" class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="fullName" name="fullName" value="<?php echo $fullName; ?>"
                            class="w-full px-4 py-3 border <?php echo $fullNameErr ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <?php if ($fullNameErr): ?>
                            <p class="error-message"><?php echo $fullNameErr; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>"
                            class="w-full px-4 py-3 border <?php echo $emailErr ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <?php if ($emailErr): ?>
                            <p class="error-message"><?php echo $emailErr; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" placeholder="Write your comment here..." rows="4"
                        class="w-full px-4 py-3 border <?php echo $messageErr ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"><?php echo $message; ?></textarea>
                    <?php if ($messageErr): ?>
                        <p class="error-message"><?php echo $messageErr; ?></p>
                    <?php endif; ?>
                </div>
                <div class="mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="saveInfo" id="saveInfo"
                            class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500">
                        <span class="ml-2 text-sm text-gray-700">
                            Save my name and email in this browser for the next time I comment
                        </span>
                    </label>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="green-btn text-white font-semibold px-10 py-3 rounded-3xl hover:bg-green-700 transition-colors">
                        Post Comments
                    </button>
                </div>
            </form>
        </div>

        <!-- Comments Section -->
        <div class="p-6 md:p-10 bg-white rounded-lg shadow-sm">
            <h3 class="text-3xl font-bold mb-6">Comments</h3>
            <div class="space-y-6">
                <?php
                $comments = getComments();
                foreach ($comments as $index => $comment):
                    ?>
                    <!-- Comment -->
                    <div class="flex items-start space-x-4 pb-6 border-b border-gray-200"
                        id="comment-<?php echo $index; ?>">
                        <div class="user-avatar"
                            style="background-color: <?php echo htmlspecialchars($comment['colorHex']); ?>">
                            <?php echo htmlspecialchars($comment['initials']); ?>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <h4 class="font-semibold text-gray-800">
                                        <?php echo htmlspecialchars($comment['fullName']); ?>
                                    </h4>
                                    <span
                                        class="text-sm text-gray-500"><?php echo htmlspecialchars($comment['date']); ?></span>
                                </div>
                                <div class="dropdown">
                                    <span class="text-gray-400 hover:text-gray-600 cursor-pointer dropdown-toggle">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </span>
                                    <div class="dropdown-menu">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="comment_id" value="<?php echo $index; ?>">
                                            <button type="submit" name="delete_comment"
                                                class="dropdown-item text-red-500 hover:bg-red-50">
                                                <i class="fas fa-trash-alt mr-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2 whitespace-pre-line">
                                <?php echo htmlspecialchars($comment['message']); ?>
                            </p>
                            <div class="flex items-center mt-3 text-gray-500 text-sm">

                                <button class="reply-btn flex items-center ml-4 hover:text-green-600 transition-colors"
                                    data-comment-id="<?php echo $index; ?>">
                                    <i class="far fa-comment mr-1"></i> Reply
                                </button>
                            </div>





                            <!-- Reply Form - Hidden by default -->
                            <div class="reply-section" id="reply-section-<?php echo $index; ?>">
                                <form class="reply-form" data-comment-id="<?php echo $index; ?>">
                                    <textarea name="reply_message" placeholder="Write your reply..." rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                                    <div class="mt-2 flex justify-end">
                                        <button type="button"
                                            class="cancel-reply bg-gray-100 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-200 transition-colors">Cancel</button>
                                        <button type="submit"
                                            class="submit-reply green-btn text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">Reply</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Replies List -->
                            <?php if (isset($comment['replies']) && !empty($comment['replies'])): ?>
                                <div class="replies-list mt-4">
                                    <h5 class="text-sm font-medium text-gray-700 mb-2">Replies</h5>
                                    <?php foreach ($comment['replies'] as $reply): ?>
                                        <div class="reply-item">
                                            <div class="flex items-center space-x-2">
                                                <h6 class="font-semibold text-gray-700">
                                                    <?php echo htmlspecialchars($reply['fullName']); ?>
                                                </h6>
                                                <span
                                                    class="text-xs text-gray-500"><?php echo htmlspecialchars($reply['date']); ?></span>
                                            </div>
                                            <p class="text-gray-600 mt-1 text-sm"><?php echo htmlspecialchars($reply['message']); ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <?php
    include '../footer.html';
    ?>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            // Check if saved info exists and populate the form
            if (localStorage.getItem('commentName') && localStorage.getItem('commentEmail')) {
                document.getElementById('fullName').value = localStorage.getItem('commentName');
                document.getElementById('email').value = localStorage.getItem('commentEmail');
                document.getElementById('saveInfo').checked = true;
            }

            // Add form submit event listener
            const form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                // If save info checkbox is checked, save to localStorage
                if (document.getElementById('saveInfo').checked) {
                    localStorage.setItem('commentName', document.getElementById('fullName').value);
                    localStorage.setItem('commentEmail', document.getElementById('email').value);

                    // Also set cookies for replies
                    document.cookie = "commentName=" + encodeURIComponent(document.getElementById('fullName').value) + "; path=/; max-age=31536000";  // 1 year
                } else {
                    // Clear saved info if checkbox is unchecked
                    localStorage.removeItem('commentName');
                    localStorage.removeItem('commentEmail');
                    document.cookie = "commentName=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                }
            });

            // Dropdown toggles
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();

                    // Close all other dropdowns first
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== this.nextElementSibling) {
                            menu.classList.remove('show');
                        }
                    });

                    // Toggle the clicked dropdown
                    const dropdownMenu = this.nextElementSibling; // Corrected from this.next
                    if (dropdownMenu) { // Check if dropdownMenu exists
                        dropdownMenu.classList.toggle('show');
                    }
                });
            });

            // Close dropdowns when clicking elsewhere
            document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            });

            // Like button functionality (Updated for PHP cookie-based like-once)
            const likeButtons = document.querySelectorAll('.like-btn');
            likeButtons.forEach(button => {
                const commentIdForInitialCheck = button.getAttribute('data-comment-id');
                // Check cookie to set initial state of the button
                // Note: PHP should ideally render the button pre-disabled/active if liked.
                // This JS check is a fallback or for dynamic updates if PHP doesn't pre-render state.
                if (document.cookie.split(';').some((item) => item.trim().startsWith(`liked_comment_${commentIdForInitialCheck}=true`))) {
                    button.classList.add('active');
                    const icon = button.querySelector('i');
                    if (icon) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    }
                    button.disabled = true;
                }

                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-comment-id');
                    const likeCountSpan = this.querySelector('.like-count');
                    const buttonIcon = this.querySelector('i');

                    if (this.disabled) { // If button is already disabled (e.g. by initial check or previous click)
                        return;
                    }

                    this.disabled = true; // Disable button immediately to prevent multiple clicks

                    const formData = new FormData();
                    formData.append('action', 'like');
                    formData.append('comment_id', commentId);

                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => { throw new Error('Server error: ' + text); });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success && data.likes !== undefined) {
                                // Successfully liked
                                if (likeCountSpan) likeCountSpan.textContent = data.likes;
                                this.classList.add('active');
                                if (buttonIcon) {
                                    buttonIcon.classList.remove('far');
                                    buttonIcon.classList.add('fas');
                                }
                                if (likeCountSpan && likeCountSpan.nextSibling && likeCountSpan.nextSibling.nodeType === Node.TEXT_NODE) {
                                    likeCountSpan.nextSibling.textContent = data.likes === 1 ? ' Like' : ' Likes';
                                }
                                // Button remains disabled as it's successfully liked and cookie is set by server
                            } else if (data.already_liked) {
                                // Already liked, server confirmed
                                if (likeCountSpan && data.likes !== undefined) likeCountSpan.textContent = data.likes;
                                this.classList.add('active');
                                if (buttonIcon) {
                                    buttonIcon.classList.remove('far');
                                    buttonIcon.classList.add('fas');
                                }
                                if (likeCountSpan && likeCountSpan.nextSibling && likeCountSpan.nextSibling.nodeType === Node.TEXT_NODE && data.likes !== undefined) {
                                    likeCountSpan.nextSibling.textContent = data.likes === 1 ? ' Like' : ' Likes';
                                }
                                // Button remains disabled
                            } else if (data.error) {
                                console.error('Error liking comment:', data.error);
                                alert('Error: ' + data.error);
                                this.disabled = false; // Re-enable button if there was an error from server logic
                            } else {
                                console.error('Unknown response from server:', data);
                                this.disabled = false; // Re-enable on unknown server response
                            }
                        })

                        .catch(error => {
                            console.error('Fetch Error:', error);
                            alert('An error occurred while trying to like the comment. Please try again.');
                            this.disabled = false; // Re-enable button on fetch error
                        });
                });
            });

            // Reply button functionality
            const replyButtons = document.querySelectorAll('.reply-btn');
            replyButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-comment-id');
                    const replySection = document.getElementById(`reply-section-${commentId}`);

                    // Hide all other reply sections first
                    document.querySelectorAll('.reply-section').forEach(section => {
                        if (section !== replySection) {
                            section.style.display = 'none';
                        }
                    });

                    // Toggle the current reply section
                    replySection.style.display = replySection.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Cancel reply buttons
            const cancelButtons = document.querySelectorAll('.cancel-reply');
            cancelButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const replySection = this.closest('.reply-section');
                    replySection.style.display = 'none';

                    // Clear the textarea
                    const textarea = replySection.querySelector('textarea');
                    textarea.value = '';
                });
            });

            // Submit reply via AJAX
            const replyForms = document.querySelectorAll('.reply-form');
            replyForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const commentId = this.getAttribute('data-comment-id');
                    const textarea = this.querySelector('textarea');
                    const replyMessage = textarea.value.trim();

                    if (replyMessage === '') {
                        alert('Please write a reply message');
                        return;
                    }

                    // Send AJAX request to post reply
                    const formData = new FormData();
                    formData.append('action', 'reply');
                    formData.append('comment_id', commentId);
                    formData.append('reply_message', replyMessage);

                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Create and add the new reply to the DOM
                                const repliesList = document.querySelector(`#comment-${commentId} .replies-list`);

                                // If no replies list exists yet, create one
                                if (!repliesList) {
                                    const newRepliesList = document.createElement('div');
                                    newRepliesList.className = 'replies-list mt-4';
                                    newRepliesList.innerHTML = `
                        <h5 class="text-sm font-medium text-gray-700 mb-2">Replies</h5>
                    `;

                                    const commentBlock = document.querySelector(`#comment-${commentId} .flex-1`);
                                    commentBlock.appendChild(newRepliesList);

                                    // Add the new reply to the newly created list
                                    addReplyToList(newRepliesList, data.reply);
                                } else {
                                    // Add the new reply to the existing list
                                    addReplyToList(repliesList, data.reply);
                                }

                                // Clear the textarea and hide the reply form
                                textarea.value = '';
                                this.closest('.reply-section').style.display = 'none';
                            } else if (data.error) {
                                alert(data.error);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Helper function to add a reply to the DOM
            function addReplyToList(repliesList, reply) {
                const replyItem = document.createElement('div');
                replyItem.className = 'reply-item';
                replyItem.innerHTML = `
        <div class="flex items-center space-x-2">
            <h6 class="font-semibold text-gray-700">${reply.fullName}</h6>
            <span class="text-xs text-gray-500">${reply.date}</span>
        </div>
        <p class="text-gray-600 mt-1 text-sm">${reply.message}</p>
    `;

                repliesList.appendChild(replyItem);
            }
        });
    </script>


</body>

</html>