{{ HTML::style('assets/css/font-awesome.min.css') }}
{{ HTML::style('editor/css/froala_style.min.css') }}
{{ HTML::style('editor/css/froala_editor.min.css') }}
{{ HTML::script('editor/js/froala_editor.min.js')}}
{{ HTML::script('editor/js/plugins/tables.min.js')}}

<script>
  $(function() {
      $('#ide').editable({
      	inlineMode: false,
      	height: 500,
      	buttons: [
      		'bold', 'italic', 'underline', 'fontFamily', 'fontSize', 'removeFormat', 'formatBlock',
      		'blockStyle', 'inlineStyle', 'align', 'insertOrderedList', 'insertUnorderedList', 
      		'outdent', 'indent', 'createLink', 'insertImage', 'insertVideo', 'table', 
      		'undo', 'redo', 'html', 'insertHorizontalRule'
      		],
      	placeholder: 'Write Something',
      	imageUploadURL: "{{ URL::to('/') }}/reseller/images/upload",
      	imageUploadParams: {
        	id: 'my_editor'
      	}
      })
  });
</script>