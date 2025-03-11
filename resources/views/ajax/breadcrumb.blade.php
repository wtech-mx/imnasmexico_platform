<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breadcrumb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const breadcrumbs = [
                { link: '#', label: 'Home' },
                { link: '#', label: 'Library' },
                { label: 'Data' }
            ];

            const breadcrumbContainer = document.querySelector('.breadcrumb');
            breadcrumbContainer.innerHTML = '';

            breadcrumbs.forEach(breadcrumb => {
                const li = document.createElement('li');
                li.classList.add('breadcrumb-item');

                if (breadcrumb.link) {
                    const a = document.createElement('a');
                    a.href = breadcrumb.link;
                    a.textContent = breadcrumb.label;
                    li.appendChild(a);
                } else {
                    li.classList.add('active');
                    li.setAttribute('aria-current', 'page');
                    li.textContent = breadcrumb.label;
                }

                breadcrumbContainer.appendChild(li);
            });
        });
    </script>
</body>
</html>
