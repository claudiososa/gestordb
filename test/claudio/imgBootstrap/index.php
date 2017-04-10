<!DOCTYPE html>
<html>
  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js"></script>
<!-- bootstrap.js below is needed if you wish to zoom and view file content
     in a larger detailed modal dialog -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
<!-- optionally if you need a theme like font awesome theme you can include
    it as mentioned below -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/fa.js"></script>
<!-- optionally if you need translation for your language then include
    locale file as mentioned below -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/<lang>.js"></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <label class="control-label">Seleccionar archivos</label>
<input id="input-20" type="file" multiple class="file-loading">
<script>
$(document).on('ready', function() {
    $("#input-20").fileinput({
       initialCaption: "Adjuntar archivos para el Informe",
        maxFileCount: 5,
        maxFileSize: 600,
        allowedFileExtensions: ["jpg", "pdf", "docx","xlsx"],
        browseClass: "btn btn-primary btn-block",
        showCaption: true,
        showRemove: false,
        showUpload: false
    });
});
</script>
  </body>
</html>
