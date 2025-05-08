<h1><u>Create News</u></h1>
    <div class="formcss">
    <form action="add_news_validate.php" method="post" enctype="multipart/form-data">
    <label for="title">Title: </label><br>
        <input type="text" name="title" id="title" placeholder="New Post Title" size="50" required>
        <br>
        <label for="description_txt">Description: </label><br>
        <textarea name="description" id="description_txt" cols="100" rows="10" placeholder="New Post Description" required></textarea><br>
        <label for="post_txt">Content: </label><br>
        <textarea name="post_txt" id="post_txt" cols="180" rows="26" placeholder="Enter Post Content" required></textarea>
        <br>
        <button type="submit" class="btn" onclick="alert('Thanks for submitting!')">Submit</button>
        <input type="file" id="pictureup" name="fileToUpload">
    </form>
    </div>
