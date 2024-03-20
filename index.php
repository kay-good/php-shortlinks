<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/add/index.php" method="post" id="form-post">
        <input type="text" name="long_url" placeholder="URL">
        <input type="submit" value="Make short">
    </form>
    <a href="" id="responce-data" target="_blank"></a>
    <script type="text/javascript">
        const responceEl = document.getElementById('responce-data')

        const form1 = document.getElementById('form-post')
        form1.addEventListener("submit", (e) => {
            e.preventDefault()
            fetch('/add/index.php', {
                method: 'POST',
                body: new FormData(form1)
            }).then((res) => res.json()).then(res => {
                responceEl.textContent = `${window.location}short?link=${res}`
                responceEl.setAttribute("href", `${window.location}short?link=${res}`)
            })
        })
    </script>
</body>

</html>