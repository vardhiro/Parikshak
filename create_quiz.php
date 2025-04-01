<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz - Parikshak</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bungee&display=swap');
        
        body {
            background-color: black;
            color: white;
            font-family: 'Bungee', sans-serif;
            text-align: center;
            padding: 20px;
        }
        input, select, button {
            font-family: 'Bungee', sans-serif;
            margin: 10px;
            padding: 10px;
        }
        .question-container {
            margin-top: 20px;
            padding: 15px;
            background: #222;
            border-radius: 8px;
            text-align: left;
        }
        .btn {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            margin: 5px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <form id="quizForm" action="save_quiz.php" method="GET">
    <h1>Create a Quiz</h1>
    <input type="text" id="quizTitle" name="quizTitle" placeholder="Enter Quiz Title" required>
    
    <!-- Buttons for Adding Questions -->
    <button class="btn" id="addMCQ">Add MCQ / Multiple Right</button>
    <button class="btn" id="addNumerical">Add Numerical</button>

        <div id="questionsContainer"></div>
        <button class="btn" type="submit">Save Quiz</button>
    </form>

    <script>
        $(document).ready(function() {
            let questionCount = 0;

            function addQuestion(type) {
                questionCount++;
                let optionsHtml = '';

                if (type === "MCQ" || type === "MULTI_RESPONSE") {
                    for (let i = 1; i <= 4; i++) {
                        optionsHtml += `
                            <div>
                                <input type="text" name="options[${questionCount}][]" placeholder="Option ${i}" required>
                                <label>Correct Answer:</label>
                                <label>
                                    <input type="radio" name="correct_option[${questionCount}][${i}]" value="1"> Yes
                                </label>
                                <label>
                                    <input type="radio" name="correct_option[${questionCount}][${i}]" value="0" checked> No
                                </label>
                            </div>
                        `;
                    }
                } else if (type === "NUMERICAL") {
                    optionsHtml = `
                        <input type="number" name="numerical_answer[${questionCount}]" placeholder="Enter Correct Answer" required>
                    `;
                }

                $("#questionsContainer").append(`
                    <div class="question-container" id="question${questionCount}">
                        <input type="text" name="question_text[]" placeholder="Enter Question" required>
                        <input type="hidden" name="question_type[]" value="${type}">
                        <div class="optionsContainer">${optionsHtml}</div>
                    </div>
                `);
            }

            $("#addMCQ").click(function() {
                addQuestion("MCQ");
            });

            $("#addNumerical").click(function() {
                addQuestion("NUMERICAL");
            });

        });
    </script>
</body>
</html>
