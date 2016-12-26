<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<script type='text/javascript'>
    window.parent.CKEDITOR.tools.callFunction(
            {!! $CKEditorFuncNum !!},
        '{!! $data['url'] !!}',
        '{!! $data['message'] !!}'
    );
</script>
</body>
</html>
