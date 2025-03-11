<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Templates</h1>
        <ul id="template-list" class="list-group">
            <!-- Templates will be loaded here -->
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const templates = [
                { id: 1, header: 'Header 1', body: 'Body 1', footer: 'Footer 1' },
                { id: 2, header: 'Header 2', body: 'Body 2', footer: 'Footer 2' },
                { id: 3, header: 'Header 3', body: 'Body 3', footer: 'Footer 3' }
            ];

            const templateList = document.getElementById('template-list');
            templateList.innerHTML = '';

            templates.forEach(template => {
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                li.textContent = `${template.header} - ${template.body} - ${template.footer}`;
                templateList.appendChild(li);
            });
        });
    </script>
</body>
</html>
