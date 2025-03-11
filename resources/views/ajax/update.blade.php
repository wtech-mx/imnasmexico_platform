<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Template</h1>
        <form id="update-template-form">
            <div class="mb-3">
                <label for="header-text" class="form-label">Header</label>
                <input type="text" class="form-control" id="header-text" name="header">
            </div>
            <div class="mb-3">
                <label for="body-text" class="form-label">Body</label>
                <textarea class="form-control" id="body-text" name="body"></textarea>
            </div>
            <div class="mb-3">
                <label for="footer-text" class="form-label">Footer</label>
                <input type="text" class="form-control" id="footer-text" name="footer">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const content = {
                HEADER: { text: 'Header Text' },
                BODY: { text: 'Body Text' },
                FOOTER: { text: 'Footer Text' }
            };

            document.getElementById('header-text').value = content.HEADER?.text;
            document.getElementById('body-text').value = content.BODY?.text;
            document.getElementById('footer-text').value = content.FOOTER?.text;

            document.getElementById('update-template-form').addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const data = {
                    header: formData.get('header'),
                    body: formData.get('body'),
                    footer: formData.get('footer')
                };

                console.log('Template updated:', data);
            });
        });
    </script>
</body>
</html>
