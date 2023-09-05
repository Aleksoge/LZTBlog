<div class="container">
    <div class="card card-form w-100">
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
                <div class="form-field">
                    <textarea id="shortdescription" name="shortdescription"></textarea>
                </div>
                <div class="form-field">
                    <textarea id="description" name="description"></textarea>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/froala_editor.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/align.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/code_view.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/colors.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/draggable.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/entities.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/file.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/font_size.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/font_family.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/image.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/link.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/lists.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/quote.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/table.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/save.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/url.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/video.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/help.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/print.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/third_party/spell_checker.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/special_characters.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/plugins/word_paste.min.js"></script>
<script type="text/javascript" src="/assets/js/editor/froala_kg.js"></script>
<script>
(function() {

	new FroalaEditor('textarea#shortdescription', {
		key: "1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe(+%$==",
		attribution: false,
		fileUploadURL: '/handler/upload_file.php',
		fileUploadParams: {
		id: 'my_editor'
		},
		imageUploadURL: '/handler/upload_image.php',
			imageUploadParams: {
			id: 'my_editor'
		},
		videoUploadURL: '/handler/upload_video.php' ,
		 videoUploadParams : {
		 id : 'my_editor'
		}
	});
	
	new FroalaEditor('textarea#description', {
		key: "1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe(+%$==",
		attribution: false,
		fileUploadURL: '/handler/upload_file.php',
		fileUploadParams: {
		id: 'my_editor'
		},
		imageUploadURL: '/handler/upload_image.php',
			imageUploadParams: {
			id: 'my_editor'
		},
		videoUploadURL: '/handler/upload_video.php' ,
		 videoUploadParams : {
		 id : 'my_editor'
		}
	});
	
})()
</script>