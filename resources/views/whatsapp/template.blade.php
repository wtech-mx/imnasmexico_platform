<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <strong id="header-text"></strong>
        <p id="body-text"></p>
        <small id="footer-text"></small>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const content = {
                HEADER: { text: 'Header Text' },
                BODY: { text: 'Body Text' },
                FOOTER: { text: 'Footer Text' }
            };

            document.getElementById('header-text').textContent = content.HEADER?.text;
            document.getElementById('body-text').textContent = content.BODY?.text;
            document.getElementById('footer-text').textContent = content.FOOTER?.text;
        });
    </script>
</body>
</html>
