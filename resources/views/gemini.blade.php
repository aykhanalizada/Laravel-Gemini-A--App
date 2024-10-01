<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q&A Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<style>
    #spinner-icon {
        font-size: 25px;
        margin-top: 20px;
    }

    /* Adjust margins for smaller screens */
    @media (max-width: 640px) {
        #spinner-icon {
            font-size: 20px;
            margin-top: 10px;
        }
    }
</style>

<body class="bg-gray-100 h-full flex items-center justify-center">
<div class="container mx-auto max-w-2xl p-4 sm:p-6 lg:p-8">
    <!-- Input Section -->
    <form id="questionForm" action="{{route('gemini')}}" method="POST">
        @csrf
        <div class="flex flex-col items-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-6 sm:mb-8 mt-4">
                <a href="{{route('home')}}">
                    Adınızı daxil edin
                </a>
            </h1>
            <input id="questionInput"
                   type="text"
                   name="question"
                   maxlength="10"
                   value="{{$question ?? null}}"
                   placeholder="Type here your name..."
                   required
                   class="w-full p-2 sm:p-3 rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <!-- Note below the input field -->
            <p class="text-gray-500 text-xs sm:text-sm mt-2 text-left w-full">
                <i class="fa-solid fa-circle-info"></i> Bəzən nəticə çıxmaya bilər. Bu zaman bir neçə dəfə cəhd edin.
            </p>

            <button
                id="submitBtn"
                class="mt-4 bg-blue-500 text-white py-2 px-4 sm:px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Submit
            </button>
        </div>
    </form>

    <!-- Response Section -->
    <div id="responseDiv" class="mt-8 p-4 sm:p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Cavab</h2>

        <div id="spinner" class="hidden justify-center items-center">
            <i id="spinner-icon" class="fa fa-spinner fa-spin text-blue-500"></i>
        </div>

        @if(isset($answer))
            <p id="answer" class="mt-2 text-gray-600">{!! $answer !!}</p>
        @endif
    </div>
</div>

<script>
    const form = document.getElementById('questionForm');
    const button = document.getElementById('submitBtn');
    const spinner = document.getElementById('spinner');
    const answerDiv = document.getElementById('answer');

    form.addEventListener('submit', function () {
        button.disabled = true;
        button.style.cursor = 'not-allowed';
        button.textContent = 'Generating...';

        // Show the spinner and hide the answer
        spinner.classList.remove('hidden'); // Show spinner
        if (answerDiv) {
            answerDiv.style.display = 'none'; // Hide the answer text
        }
    });
</script>
</body>
</html>
