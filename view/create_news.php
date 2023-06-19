<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            color: #333333;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555555;
        }

        input[type="text"],
        textarea,
        input[type="number"],
        select,
        input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 14px;
            color: #555555;
            margin-bottom: 15px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        select {
            height: 35px;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Create News</h1>

    <form action="../function/fn-create-news.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="image">Image URL:</label>
        <input type="file" name="image">

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="view">View Count:</label>
        <input type="number" id="view" name="view" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>



        <input type="submit" value="Create">
    </form>
</body>

</html>