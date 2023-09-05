<div class="container">
    <div class="card card-form">
        <div class="card-header">
            <h2>Вход</h2>
        </div>
        <div class="card-body">
            <form action="#" method="POST" id="loginForm">
                <?php set_csrf(); ?>
                <div class="form-field">
                    <label for="username">Имя пользователя</label>
                    <input type="text" id="username" name="username" class="text-field" required>
                </div>
                <div class="form-field">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" class="text-field" required>
                </div>
                <div class="form-field">
                    <input type="checkbox" name="remember" id="remember" checked>
                    <label for="remember">Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-main w-100">Войти</button>
            </form>
        </div>
        <div class="card-footer">
                <div class="register-link">
                    <p>Нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
                </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        sendFetchEvent(event, '/api/login', '/');
    });
</script>