<link rel="stylesheet" href="/assets/css/editor/froala_editor.css">
<link rel="stylesheet" href="/assets/css/editor/froala_style.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/code_view.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/draggable.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/colors.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/emoticons.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/image_manager.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/image.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/line_breaker.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/table.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/char_counter.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/video.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/fullscreen.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/file.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/quick_insert.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/help.css">
<link rel="stylesheet" href="/assets/css/editor/third_party/spell_checker.css">
<link rel="stylesheet" href="/assets/css/editor/plugins/special_characters.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<div class="container">
    <div class="card card-form mw-100">
        <div class="card-header">
            <h2>Вход</h2>
        </div>
        <div class="card-body">
            <form action="#" method="POST" id="articleForm">
                <?php set_csrf(); ?>
                <?= (isset($item_id)) ? '<input type="hidden" name="item_id" value="'.$item_id.'">' : NULL ?>
                <div class="form-field">
                    <label for="title">Заголовок статьи</label>
                    <input type="text" id="title" name="title" class="text-field" required>
                </div>
                <div class="form-field">
                    <label for="author">Имя автора статьи</label>
                    <input type="text" id="author" name="author" class="text-field">
                </div>
                <div class="form-field">
                    <label>Путь до картинки</label>
                    <input type="text" class="text-field" name="img_path" placeholder="Путь до картинки">
                </div>
                <div class="form-field">
                    <label>Или загрузить картинку</label>
                    <input type="file" class="text-field" name="img_load" placeholder="Или загрузить иконку">
                </div>
                <div class="form-field">
                    <label for="shortdescription">Краткое содержание</label>
                    <textarea id="shortdescription" class="text-field w-100" name="shortdescription"></textarea>
                </div>
                <div class="form-field">
                    <label for="description">Полное содержание</label>
                    <textarea id="description" class="text-field w-100" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-main w-100">Сохранить</button>
            </form>
        </div>
        <div class="card-footer">
                <div class="register-link">
                    <p><a href="/admin">Вернуться в панель</a></p>
                </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('articleForm').addEventListener('submit', function(event) {
        sendFetchEvent(event, '/api/articles', '/admin/articles', 'POST');
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
		fileUploadURL: '/api/editor_upload_file',
		fileUploadParams: {
		id: 'my_editor'
		},
		imageUploadURL: '/api/editor_upload_image',
			imageUploadParams: {
			id: 'my_editor'
		},
		videoUploadURL: '/api/editor_upload_video' ,
		 videoUploadParams : {
		 id : 'my_editor'
		},
        htmlAllowedTags: [],
        charCounterMax: 300
	});
	
	new FroalaEditor('textarea#description', {
		key: "1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe(+%$==",
		attribution: false,
		fileUploadURL: '/api/editor_upload_file',
		fileUploadParams: {
		id: 'my_editor'
		},
		imageUploadURL: '/api/editor_upload_image',
			imageUploadParams: {
			id: 'my_editor'
		},
		videoUploadURL: '/api/editor_upload_video' ,
		 videoUploadParams : {
		 id : 'my_editor'
		}
	});
	
})()
</script>