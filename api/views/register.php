<div class="container">
    <div class="card card-form">
        <div class="card-header">
            <h2>Регистрация</h2>
        </div>
        <div class="card-body">
            <form action="#" id="registerForm">
            <div class="form-field">
                    <label for="username">Имя пользователя</label>
                    <input type="text" id="username" name="username" class="text-field" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="text-field" required>
                </div>
                <div class="form-field">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" class="text-field" required>
                </div>
                <div class="form-field">
                    <label for="password_2">Повторите пароль</label>
                    <input type="password" id="password_2" name="password_2" class="text-field" required>
                </div>
                <button type="submit" class="btn btn-main w-100">Зарегистрироваться</button>
            </form>
        </div>
        <div class="card-footer">
                <div class="register-link"><p>Уже есть аккаунты? <a href="/login">Войти</a></p></div>
        </div>
    </div>
</div>