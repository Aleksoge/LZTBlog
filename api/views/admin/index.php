<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Администрирование</h2>
        </div>
        <div class="card-body">
            <a href="/admin/articles" class="btn btn-main w-100 my-1">Список статей</a>
            <a href="/admin/article" class="btn btn-main w-100 my-1">Добавить статью</a>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        sendFetchEvent(event, '/api/login', '/');
    });
</script>